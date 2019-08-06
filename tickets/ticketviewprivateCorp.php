<?php include '../view/header.php'; ?>
<section>
    <div class="sectionContent">
        <div class="message"><?= $message ?></div>
        <form action="index.php" method="post">
            <h2>#<?= $ticketID ?> - <input type="text" name="subject" id="Ticket-Subject-Title" value="<?= $ticket['TicketSubject']; ?>"></h2>
            <input type="hidden" name="action" value="corpUpdate">
            <input type="hidden" name="ticketID" value="<?= $ticketID ?>">
            <div class="editTicketButtons">
                <a id="cancel" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">
                    <input type="button" value="Cancel">
                </a>
                <input type="submit" value="save">
            </div>
            <div class="ticketDetails">
                <div class="ticketsummary">
                    <label for="createdate">Created On:&nbsp;<?= $ticket['CreateDate'] ?></label>&nbsp;-&nbsp;
                    <label for="creator">Created By:&nbsp;<?= $ticket['CorporateName'] ?></label><br>
                    <label for="ticketStatus">Ticket Status</label>
                    <select name="ticketStatus" id="ticketStatus">
                        <option value="Open" <?php echo ($ticket['TicketStatus'] == "Open") ? "selected='true'" : '' ?>>Open</option>
                        <option value="Working" <?php echo $ticket['TicketStatus'] == "Working" ? "selected='true'" : '' ?>>Working</option>
                        <option value="Closed" <?php echo $ticket['TicketStatus'] == "Closed" ? "selected='true'" : '' ?>>Closed</option>
                    </select>
                    <label for="ticketStatusReason">Status Reason</label>
                    <select name="ticketStatusReason" id="ticketStatusReason">
                        <option value='Pending Assignment' <?php echo ($ticket['TicketStatusReason'] == "Pending Assignment") ? "selected='true'" : ''?>>Pending Assignment</option>
                        <option value='Pending Schedule' <?php echo ($ticket['TicketStatusReason'] == "Pending Schedule") ? "selected='true'" : ''?>>Pending Schedule</option>
                    </select>
                </div>
                <div class="ticketDescription">
                    <label for="description">Description</label><br>
                    <textarea name="description" id="description" cols="50" rows="7"><?= $ticket['TicketDescription'] ?></textarea><br>
                </div>
                <div class="customerSummary">
                    <label for="ticketPriority">Priority Level:&nbsp;</label>
                        <select name="ticketPriority" id="ticketPriority">
                        <option value="1" <?php echo ($ticket['Priority'] == "1") ? "selected=true" : ''?> >Question</option>
                        <option value="2" <?php echo ($ticket['Priority'] == "2") ? "selected=true" : ''?> >General Issue</option>
                        <option value="3" <?php echo ($ticket['Priority'] == "3") ? "selected=true" : ''?> >Degraded Service</option>
                        <option value="4" <?php echo ($ticket['Priority'] == "4") ? "selected=true" : ''?> >Business Critical</option>
                        </select><br>
                    <label for="customerName">Customer Name:&nbsp;<?= $ticket['CustomerName'] ?></label><br>
                    <label for="customerPhone">Contact Phone:&nbsp;<?= preg_replace("/(\d{3})(\d{3})(\d{4})/", "($1) $2-$3", $ticket['CustomerPhone']); ?></label><br>
                    <label for="customerVIP">VIP contract:&nbsp;<?= ($ticket['VIP']) ? 'Yes' : 'No' ?></label><br>
                    <label for="CustomerRegion">Region:&nbsp;<?= $ticket['RegionName'] ?></label>
                </div>
                <div class=technicianSummary>
                    <?php if (isset($ticket['TechnicianName'])) : ?>
                        <input type="hidden" name="assignedTechnicianID" value="<?=$ticket['TechID']?>">
                        <label for="assignedTechnicianName">Technician Name:&nbsp;<?= $ticket['TechnicianName'] ?></label><br>
                        <label for="assignedTechnicianPhone">Contact Phone:&nbsp;<?= preg_replace("/(\d{3})(\d{3})(\d{4})/", "($1) $2-$3", $ticket['TechnicianPhone']); ?></label><br>
                        <label for="AssignTech">Reassign to technician:&nbsp;</label>
                        <select name="technicianID" id="technician">
                            <?php foreach ($technicians as $technician) : ?>
                                <option value="<?= $technician['UserID']; ?>" <?php echo ($ticket['TechID'] == $technician['UserID']) ?: 'selected'?> >
                                    <?= $technician['Name'] . '-' . $technician['RegionName'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    <?php else: ?>
                        <label for="AssignTech">Assign a technician:&nbsp;</label>
                        <select name="technicianID" id="technician">
                            <option value="null"></option>
                            <?php foreach ($technicians as $technician) : ?>
                                <option value="<?= $technician['UserID']; ?>">
                                    <?= $technician['Name'] . '-' . $technician['RegionName'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    <?php endif; ?>
                </div>
                <div class="ticketContact">
                    <label for="lastContact">Last Contacted:&nbsp;<?= $ticket['LastContactDate'] ?></label><br>
                    <label for="nextAppointment">Next Appointment:&nbsp;<?= $ticket['NextAppointment'] ?></label><br>
                </div>
            </div>
        </form>
        <hr>
        <?php if (count($comments) > 0) :
            foreach ($comments as $comment) : ?>
                <div class="comment <?php echo ($comment['Internal'] ? 'privateComment' : 'publicComment' );?>">
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
                <select name="private" id="private">
                    <option value="0">Public</option>
                    <option value="1">Private</option>
                </select><br>
                <textarea name="newCommentBody" id="newCommentBody" cols="50" rows="5"></textarea><br>
                <input type="hidden" name="PostAction" value="privateview">
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</section>
<script src="/scripts/jquery.js"></script>
<script>
    $(document).ready(function() {

        $("#ticketStatus").change(function() {
            var val = $(this).val();
            if (val == "Open") {
                $("#ticketStatusReason").html(`<option value='Pending Assignment' <?php echo ($ticket['TicketStatusReason'] == "Pending Assignment") ? "selected='true'" : ''?>>Pending Assignment</option>
                                               <option value='Pending Schedule' <?php echo ($ticket['TicketStatusReason'] == "Pending Schedule") ? "selected='true'" : ''?>>Pending Schedule</option>`);
            } else if (val == "Working") {
                $("#ticketStatusReason").html(`<option value='Pending Schedule' <?php echo ($ticket['TicketStatusReason'] == "Pending Schedule") ? "selected='true'" : ''?>>Pending Schedule</option>
                                               <option value='Service Scheduled' <?php echo ($ticket['TicketStatusReason'] == "Service Scheduled") ? "selected='true'" : ''?>>Service Scheduled</option>
                                               <option value='Attempting Contact' <?php echo ($ticket['TicketStatusReason'] == "Attempting Contact") ? "selected='true'" : ''?>>Attempting Contact</option>
                                               <option value='To be Reassigned' <?php echo ($ticket['TicketStatusReason'] == "To be Reassigned") ? "selected='true'" : ''?>>To be Reassigned</option>
                                               <option value='Parts Requested' <?php echo ($ticket['TicketStatusReason'] == "Parts Requested") ? "selected='true'" : ''?>>Parts Requested</option>
                                               <option value='Pending Corporate Action'<?php echo ($ticket['TicketStatusReason'] == "Pending Corporate Action") ? "selected='true'" : ''?>>Pending Corporate Action</option>`);
            } else if (val == "Closed") {
                $("#ticketStatusReason").html(`<option value='Customer Unresponsive' <?php echo ($ticket['TicketStatusReason'] == "Customer Unresponsive") ? "selected='true'" : ''?>>Customer Unresponsive</option>
                                               <option value='Service Complete' <?php echo ($ticket['TicketStatusReason'] == "Service Complete") ? "selected='true'" : ''?>>Service Complete</option>
                                               <option value='Cancelled' <?php echo ($ticket['TicketStatusReason'] == "Cancelled ") ? "selected='true'" : ''?>>Cancelled</option>
                                               <option value='Refused Service' <?php echo ($ticket['TicketStatusReason'] == "Refused Service") ? "selected='true'" : ''?>>Refused Service</option>
                                               <option value='Unable to Complete' <?php echo ($ticket['TicketStatusReason'] == "Unable to Complete") ? "selected='true'" : ''?>>Unable to Complete</option>
                                               <option value='Duplicate Ticket' <?php echo ($ticket['TicketStatusReason'] == "'Duplicate Ticket") ? "selected='true'" : ''?>>Duplicate Ticket</option>
                                               <option value='Pending Corporate Action' <?php echo ($ticket['TicketStatusReason'] == "Pending Corporate Action") ? "selected='true'" : ''?>>Pending Corporate Action</option>`);
            }
        });
    });
</script>
<?php include '../view/footer.php'; ?>