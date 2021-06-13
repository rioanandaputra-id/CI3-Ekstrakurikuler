              <div class="box box-info">
                <div class="box-header">
                  <i class="fa fa-envelope"></i>
                  <h3 class="box-title">Kirimkan E-mail</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <form action="" method="post">
                    <div class="form-group">
                      <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control" name="subject" placeholder="Subject">
                    </div>
                    <div>
                      <textarea name='message' placeholder="Message" style="width: 100%; height: 232px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                      <?php 
                        if (isset($_POST[kirim])){
                          $name='sisteminformasi-sekolah.co';
                          $email=$_POST['emailto'];
                          $subject=$_POST['subject'];
                          $message=$_POST['message'];

                          $to=$email;
                          $message="From:$name <br />".$message;
                          $headers = "MIME-Version: 1.0" . "\r\n";
                          $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
                          // More headers
                          $headers .= 'From: admin@sman3bukittinggi.sch.id <noreply@sman3bukittinggi.sch.id>'."\r\n" . 'Reply-To: '.$name.' <'.$email.'>'."\r\n";
                          $headers .= 'Cc: admin@sman3bukittinggi.sch.id' . "\r\n"; //untuk cc lebih dari satu tinggal kasih koma
                          @mail($to,$subject,$message,$headers);
                          if(@mail){
                            echo "<center>Email sent successfully !!</center>";  
                          }
                        }
                      ?>
                </div>
                <div class="box-footer clearfix">
                  <button type='submit' name='kirim' class="pull-right btn btn-default" id="sendEmail">Send <i class="fa fa-arrow-circle-right"></i></button>
                </div>
                </form>
              </div>
