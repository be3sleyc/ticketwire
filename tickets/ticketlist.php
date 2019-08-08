<?php include '../view/header.php';
if (isset($_POST['OpenClosedAll'])) {
    $status = filter_input(INPUT_POST, 'OpenClosedAll');
} else {
    $status = 'Open';
}
?>
<section>
    <div class="sectionContent">
    <br>
        <form class='ticketViewSelect' action="./" method="post">
            <label for="OpenClosedAll">Ticket Status Filter:&nbsp;</label>
            <select name="OpenClosedAll" id="OpenClosedAll" onchange="this.form.submit()">
                <option value="Open" <?php if ($status == 'Open') {
                                            echo ('selected');
                                        } ?>>Open</option>
                <option value="All" <?php if ($status == 'All') {
                                        echo ('selected');
                                    } ?>>All</option>
                <option value="Closed" <?php if ($status == 'Closed') {
                                            echo ('selected');
                                        } ?>>Closed</option>
            </select>
        </form>
        <table class="ticketTable">
            <tr>
                <th>Ticket id</th>
                <th>Creation Date</th>
                <th>Priority</th>
                <th>Subject</th>
                <?php switch ($_SESSION['user_role']) {
                    case 'Customer':
                        echo '<th>Technician</th>';
                        break;
                    default:
                        echo '<th>Customer</th>';
                        break;
                } ?>
                <?php if ($_SESSION['user_role'] != 'Customer') :
                    echo '<th>Last Contact</th>';
                endif ?>
                <th>Last Comment</th>
                <th>Ticket Status</th>
            </tr>

            <?php foreach ($tickets as $ticket) :
                switch ($status) {
                    case 'All':
                        if ($_SESSION['user_role'] == 'Customer') : ?>
                        <tr class="ticketlink" onclick="window.location='../tickets/index.php?action=view&ticketID=<?= $ticket['TicketID'] ?>';">
                        <?php else : ?>
                        <tr class="ticketlink" onclick="window.location='../tickets/index.php?action=privateview&ticketID=<?= $ticket['TicketID'] ?>';">
                        <?php endif; ?>
                        <td><?= $ticket['TicketID'] ?></td>
                        <td><?= $ticket['CreateDate'] ?></td>
                        <td><?= $ticket['Priority'] ?></td>
                        <td><?= $ticket['TicketSubject'] ?></td>
                        <?php switch ($_SESSION['user_role']) {
                            case 'Customer':
                                $accountName = $ticket['TechnicianName'];
                                break;
                            default:
                                $accountName = $ticket['CustomerName'];
                                break;
                        }
                        echo '<td>' . $accountName . '</td>';
                        ?>
                        <?php if ($_SESSION['user_role'] != 'Customer') :
                            echo '<td>' . $ticket['LastContactDate'] . '</td>';
                        endif; ?>
                        <td><?= $ticket['LastCommentDate'] ?></td>
                        <td><?= $ticket['TicketStatus'] . ' - ' . $ticket['TicketStatusReason'] ?></td>
                    </tr>
                    <?php break;
                case 'Open':
                    if ($ticket['TicketStatus'] != 'Closed' && $ticket['TicketStatusReason'] != 'Closed') :
                        if ($_SESSION['user_role'] == 'Customer') : ?>
                            <tr class="ticketlink" onclick="window.location='../tickets/index.php?action=view&ticketID=<?= $ticket['TicketID'] ?>';">
                            <?php else : ?>
                            <tr class="ticketlink" onclick="window.location='../tickets/index.php?action=privateview&ticketID=<?= $ticket['TicketID'] ?>';">
                            <?php endif; ?>
                            <td><?= $ticket['TicketID'] ?></td>
                            <td><?= $ticket['CreateDate'] ?></td>
                            <td><?= $ticket['Priority'] ?></td>
                            <td><?= $ticket['TicketSubject'] ?></td>
                            <?php switch ($_SESSION['user_role']) {
                                case 'Customer':
                                    $accountName = $ticket['TechnicianName'];
                                    break;
                                default:
                                    $accountName = $ticket['CustomerName'];
                                    break;
                            }
                            echo '<td>' . $accountName . '</td>';
                            ?>
                            <?php if ($_SESSION['user_role'] != 'Customer') :
                                echo '<td>' . $ticket['LastContactDate'] . '</td>';
                            endif; ?>
                            <td><?= $ticket['LastCommentDate'] ?></td>
                            <td><?= $ticket['TicketStatus'] . ' - ' . $ticket['TicketStatusReason'] ?></td>
                        </tr>
                    <?php endif;
                    break;
                case 'Closed':
                    if ($ticket['TicketStatus'] == 'Closed' || $ticket['TicketStatusReason'] == 'Closed') :
                        if ($_SESSION['user_role'] == 'Customer') : ?>
                            <tr class="ticketlink" onclick="window.location='../tickets/index.php?action=view&ticketID=<?= $ticket['TicketID'] ?>';">
                            <?php else : ?>
                            <tr class="ticketlink" onclick="window.location='../tickets/index.php?action=privateview&ticketID=<?= $ticket['TicketID'] ?>';">
                            <?php endif; ?>
                            <td><?= $ticket['TicketID'] ?></td>
                            <td><?= $ticket['CreateDate'] ?></td>
                            <td><?= $ticket['Priority'] ?></td>
                            <td><?= $ticket['TicketSubject'] ?></td>
                            <?php switch ($_SESSION['user_role']) {
                                case 'Customer':
                                    $accountName = $ticket['TechnicianName'];
                                    break;
                                default:
                                    $accountName = $ticket['CustomerName'];
                                    break;
                            }
                            echo '<td>' . $accountName . '</td>';
                            ?>
                            <td><?= $ticket['LastCommentDate'] ?></td>
                            <td><?= $ticket['TicketStatus'] . ' - ' . $ticket['TicketStatusReason'] ?></td>
                        </tr>
                    <?php endif;
                    break;
                default:
                    break;
            }
        endforeach; ?>
        </table>
        <?php
        if (count($tickets) == 0) {
            echo '<p>You don\'t have any tickets</p>';
        }
        ?>
    </div>
</section>
<?php include '../view/footer.php'; ?>