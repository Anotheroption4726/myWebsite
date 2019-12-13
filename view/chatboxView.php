<?php $title = 'Chatbox'; ?>

<?php ob_start(); ?>

  <div class="container">
    <div class="row">
      <div class="col-12 msg_history_display">
          <div class="msg_history">
                
                <?php
                  while ($data = $req->fetch())
                  {
                    if ($data['sender_id'] == $loggedUserId)
                    {
                ?>

                      <div class="outgoing_msg">
                        <div class="sent_msg">
                          <p style="overflow-wrap: break-word;"><?= htmlspecialchars($data['message']) ?></p>
                            <span class="time_date"><?= htmlspecialchars($data['posting_hour']) ?>:<?= htmlspecialchars($data['posting_minute']) ?> | <?= htmlspecialchars($data['posting_day']) ?></span>
                        </div>
                      </div>

                <?php
                    }
                    else
                    {
                ?>

                      <div class="incoming_msg">
                        <div class="received_msg">
                          <div class="received_withd_msg">
                            <p style="overflow-wrap: break-word;"><?= htmlspecialchars($data['message']) ?></p>
                              <span class="time_date"><?= htmlspecialchars($data['posting_hour']) ?>:<?= htmlspecialchars($data['posting_minute']) ?> | <?= htmlspecialchars($data['posting_day']) ?></span>
                                </div>
                              </div>
                            </div>

                <?php
                    }
                  }
                ?>

          </div>
      </div>

      </div>
        <form class="row" method="post" action="chatbox.php">
          <div class="col-10 send_msg_input_column">
            <textarea class="text_area send_msg_input" placeholder="Type a message" name="message_input" required></textarea>
          </div>
          <div class="col-2 send_msg_button_column">
            <!-- !!! Change type from "submit" to "button" when using javascript !!! -->
            <button class="send_msg_button" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
          </div>
        </form>
      </div>

      <div>
        <a href="profile.php">Back to profile</a>
      </div>

<?php $body_content = ob_get_clean(); ?>

<?php require('./view/template.php'); ?>