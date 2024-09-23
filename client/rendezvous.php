<?php
session_start();
require_once '../includes/config.php';
include '../includes/header.php';

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "Vous devez vous connecter d'abord";
    header('location: login.php');
    exit();
}

$username = $_SESSION['username'];

// Récupération des informations de l'utilisateur depuis la base de données
$query = "SELECT * FROM users WHERE username=?";
$stmt = $db->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Traitement du formulaire de rendez-vous
    $reason = mysqli_real_escape_string($db, $_POST['reason']);
    $appointment_date = mysqli_real_escape_string($db, $_POST['appointment_date']);
    $appointment_time = mysqli_real_escape_string($db, $_POST['appointment_time']);
    
    $user_id = $user['id'];
    $user_name = $user['username'];

    if (empty($reason)) {
        $errors[] = "La raison est requise";
    }
    if (empty($appointment_date)) {
        $errors[] = "La date du rendez-vous est requise";
    }
    if (empty($appointment_time)) {
        $errors[] = "L'heure du rendez-vous est requise";
    }

    if (empty($errors)) {
        $appointment_start = $appointment_date . ' ' . $appointment_time;
        $appointment_end = date('Y-m-d H:i:s', strtotime($appointment_start . ' + 30 minutes'));

        // Vérifier s'il y a un conflit de rendez-vous
        $check_query = "SELECT * FROM rendezvous 
                        WHERE (appointment_date < ? AND DATE_ADD(appointment_date, INTERVAL 30 MINUTE) > ?)";
        $stmt = $db->prepare($check_query);
        $stmt->bind_param('ss', $appointment_end, $appointment_start);
        $stmt->execute();
        $existing_appointment = $stmt->get_result()->fetch_assoc();

        if ($existing_appointment) {
            $errors[] = "Un rendez-vous est déjà pris durant cette période. Veuillez choisir un autre moment.";
        } else {
            $query = "INSERT INTO rendezvous (user_id, user_name, reason, appointment_date, status) 
                      VALUES (?, ?, ?, ?, 'En attente')";
            $stmt = $db->prepare($query);
            $stmt->bind_param('isss', $user_id, $user_name, $reason, $appointment_start);
            $stmt->execute();

            $_SESSION['success'] = "Rendez-vous pris avec succès!";
            header('location: profile.php');
        }
    }
}

// Récupération des rendez-vous existants pour les afficher dans le calendrier
$query = "SELECT * FROM rendezvous";
$stmt = $db->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

$appointments = [];
while ($row = $result->fetch_assoc()) {
    $appointments[] = [
        'title' => $row['reason'],
        'start' => $row['appointment_date'],
        'end' => date('Y-m-d H:i:s', strtotime($row['appointment_date'] . ' + 30 minutes'))
    ];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre un rendez-vous</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
</head>
<body>

    <div class="form-container">
        <div class="form-header">
            <h2>Prendre un rendez-vous</h2>
        </div>
        <form method="post" action="rendezvous.php">
            <?php if (!empty($errors)) : ?>
                <div class="error">
                    <?php foreach ($errors as $error) : ?>
                        <p><?php echo htmlspecialchars($error); ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="input-group">
                <label>Nom</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" readonly>
            </div>
            <div class="input-group">
                <label>Raison du rendez-vous</label>
                <input type="text" name="reason" required>
            </div>
            <div class="input-group">
                <label>Date du rendez-vous</label>
                <input type="date" name="appointment_date" required>
            </div>
            <div class="input-group">
                <label>Heure du rendez-vous</label>
                <input type="time" name="appointment_time" required>
            </div>
            <div id="calendar"></div>
            <div class="input-group">
                <button type="submit" class="btn">Demander un rendez-vous</button>
            </div>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: <?php echo json_encode($appointments); ?>,
            selectable: true,
            select: function(info) {
                var dateStr = prompt('Entrez la raison du rendez-vous pour ' + info.startStr);
                if (dateStr) {
                    var eventData = {
                        title: dateStr,
                        start: info.startStr,
                        end: info.endStr
                    };
                    calendar.addEvent(eventData);
                }
            },
            dateClick: function(info) {
                var date = info.dateStr;
                if (confirm('Voulez-vous choisir cette date pour votre rendez-vous?')) {
                    document.getElementById('appointment_date').value = date;
                }
            }
        });

        calendar.render();
    });
    </script>
            <?php include '../includes/footer.php';?>
</body>
</html>
