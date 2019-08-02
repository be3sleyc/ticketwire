<?php include '../view/header.php';?>
<section>
    <head>
        <title>Ticket View</title>
    </head>
    <table>
        <thead>
            <tr>
                <th class="ticketlink">Ticket ID</th>
                <th class="ticketlink">Customer Name</th>
                <th class="ticketlink">Create Date</th>
                <th class="ticketlink">Next Appointment</th>
                <th class="ticketlink">Last Contact Date</th>
                <th class="ticketlink">Priority</th>
                <th class="ticketlink">Ticket Subject</th>
                <th class="ticketlink">Ticket Description</th>
                <th class="ticketlink">Ticket Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tickets as $ticket): ?>
            <tr>
                    <td class="ticketlink"><a href=""><?=$ticket['TicketID']?></a></td>
                    <td class="ticketlink"><a href=""><?=$ticket['CustomerName']?></a></td>
                    <td class="ticketlink"><a href=""><?=$ticket['CreateDate']?></a></td>
                    <td class="ticketlink"><a href=""><?=$ticket['NextAppointment']?></a></td>
                    <td class="ticketlink"><a href=""><?=$ticket['LastContactDate']?></a></td>
                    <td class="ticketlink"><a href=""><?=$ticket['Priority']?></a></td>
                    <td class="ticketlink"><a href=""><?=$ticket['TicketSubject']?></a></td>
                    <td class="ticketlink"><a href=""><?=$ticket['TicketDescription']?></a></td>
                    <td class="ticketlink"><a href=""><?=$ticket['TicketStatus']?></a></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</section>
<?php include '../view/footer.php'?>