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
            <input type="hidden" name="action" value='list'>
            <input type="hidden" name="team" value=1>
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
        <table>
            <tr>
                <th>Ticket id</th>
                <th>Priority</th>
                <th>Subject</th>
                <th>Technician</th>
                <th>Customer</th>
                <th>Creation Date</th>
                <th>Last Comment</th>
                <th>Ticket Status</th>
            </tr>

            <?php foreach ($tickets as $ticket) :
                if (isset($status)) :
                    if ($status == 'All' || $status == $ticket['TicketStatus'] || $status == $ticket['TicketStatusReason']) : ?>
                        <tr onclick="window.location='../tickets/index.php?action=privateview&ticketID=<?=$ticket['TicketID']?>';">
                            <td><?= $ticket['TicketID'] ?></td>
                            <td><?= $ticket['Priority'] ?></td>
                            <td><?= $ticket['TicketSubject'] ?></td>
                            <td><?= $ticket['TechnicianName'] ?></td>
                            <td><?= $ticket['CustomerName'] ?></td>
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