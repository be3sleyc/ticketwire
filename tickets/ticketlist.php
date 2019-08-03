<?php include '../view/header.php';
if (isset($_POST['OpenClosedAll'])) {
    $status = filter_input(INPUT_POST, 'OpenClosedAll');
} else {
    $status = 'Open';
}
?>
<section>
    <div class="sectionContent">
        <form class='ticketViewSelect' action="./" method="post">
            <select name="OpenClosedAll" id="OpenClosedAll" onchange="this.form.submit()">
                <option value="Open" <?php if ($status=='Open') { echo('selected');}?>>Open</option>
                <option value="All" <?php if ($status=='All') { echo('selected');}?>>All</option>
                <option value="Closed" <?php if ($status=='Closed') { echo('selected');}?>>Closed</option>
            </select>
        </form>
        <table>
            <tr>
                <th>Ticket id</th>
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
                <th>Creation Date</th>
                <th>Last Comment</th>
                <th>Ticket Status</th>
            </tr>

            <?php foreach ($tickets as $ticket) :
                if (isset($status)) :
                    if ($status == 'All' || $status == $ticket['TicketStatus'] || $status == $ticket['TicketStatusReason']) : ?>
                        <td><?= $ticket['TicketID'] ?></td>
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
                        <td><?= $ticket['CreateDate'] ?></td>
                        <td>null</td>
                        <td><?= $ticket['TicketStatus'] . ' - ' . $ticket['TicketStatusReason'] ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </div>
</section>
<?php include '../view/footer.php'; ?>