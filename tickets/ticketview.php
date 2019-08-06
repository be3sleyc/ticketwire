<?php include '../view/header.php'; ?>
<section>
    <div class="sectionContent">
        <div class="message"><?= $message ?></div>
            <h2>#<?= $ticketID ?> - <?= $ticket['TicketSubject']; ?></h2>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="ticketID" value="<?= $ticketID ?>">
            <div class="ticketDetails">
                <div class="ticketsummary">
                    <label for="createdate">Created On:&nbsp;<?= $ticket['CreateDate'] ?></label>&nbsp;-&nbsp;
                    <label for="creator">Created By:&nbsp;<?= $ticket['CorporateName'] ?></label><br>
                    <label for="ticketStatus">Ticket Status:&nbsp;<?= $ticket['TicketStatus'] ?></label>&nbsp;-&nbsp;
                    <label for="ticketStatusReason">Status Reason:&nbsp;<?= $ticket['TicketStatusReason'] ?></label>
                </div>
                <div class="ticketDescription">
                    <label for="description">Description</label><br>
                    <textarea name="description" id="description" cols="50" rows="7" readonly><?= $ticket['TicketDescription'] ?></textarea><br>
                </div>
                <div class="customerSummary">
                    <label for="ticketPriority">Priority Level:&nbsp;<?= $ticket['Priority'] ?></label><br>
                    <label for="customerName">Customer Name:&nbsp;<?= $ticket['CustomerName'] ?></label><br>
                    <label for="customerPhone">Contact Phone:&nbsp;<?= preg_replace("/(\d{3})(\d{3})(\d{4})/", "($1) $2-$3", $ticket['CustomerPhone']); ?></label><br>
                    <label for="customerVIP">VIP contract:&nbsp;<?= ($ticket['VIP']) ? 'Yes' : 'No' ?></label><br>
                    <label for="CustomerRegion">Region:&nbsp;<?= $ticket['RegionName'] ?></label>
                </div>
                <div class=technicianSummary>
                    <?php if (isset($ticket['TechnicianName'])) : ?>
                        <label for="technicianName">Technician Name:&nbsp;<?= $ticket['TechnicianName'] ?></label><br>
                        <label for="technicianPhone">Contact Phone:&nbsp;<?= preg_replace("/(\d{3})(\d{3})(\d{4})/", "($1) $2-$3", $ticket['TechnicianPhone']); ?></label><br>
                    <?php elseif (substr($_SESSION['user_role'], 0, 9) == 'Corporate') : ?>
                        <label for="AssignTech">Assign a technician</label>
                        <select name="technician" id="technician">
                            <option value="null"></option>
                            <?php foreach ($technicians as $technician) : ?>
                                <option value="<?= $technician['UserID']; ?>">
                                    <?= $technician['Name'] . '-' . $technician['RegionName'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    <?php else : ?>
                        <label for="technicianName">Technician Name:&nbsp;<?= $ticket['TechnicianName'] ?></label><br>
                    <?php endif; ?>
                </div>
                <div class="ticketContact">
                    <?php if(ISSET($ticket['NextAppointment'])): 
                        $date = new DATETIME($ticket['NextAppointment']); ?>
                        <label for="nextAppointment">Next Appointment:&nbsp;<?=$date->format('M d Y'); ?></label><br>
                    <?php endif;?>
                </div>
            </div>
            <hr>
            <?php if (count($comments) > 0) :
                foreach ($comments as $comment) : ?>
                    <div class="comment">
                        <div class="commentDate"><?= $comment['CommentDate'] ?></div>
                        <div class="commentCreator"><?= $comment['Commentor'] ?></div>
                        <div class='commentBody'><?= $comment['CommentBody'] ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>This ticket has no comments.</p>
                <h3>Add a Comment</h3>
            <?php endif; ?>
            <div class="newComment">
                <form action="index.php" method="post">
                    <input type="hidden" name="action" value="postComment">
                    <input type="hidden" name="ticketID" value="<?= $ticketID ?>">
                    <input type="hidden" name="newCommentAuthorID" value=<?= $_SESSION['user_id'] ?>>
                    <input type="hidden" name="private" value="0">
                    <textarea name="newCommentBody" id="newCommentBody" cols="50" rows="5"></textarea><br>
                    <input type="hidden" name="PostAction" value="view">
                    <button type="submit">Submit</button>
                </form>
            </div>
        </form>
    </div>
</section>
<?php include '../view/footer.php'; ?>