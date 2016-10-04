<?php
                if(!isLoggedIn(null))
                {
                    ?>
					<div class="row navRow">
								<div class="span12">
									<div class="navbar">
										<div class="navbar-inner">
											<ul class="nav">
												<li><p>Вы не вошли в систему</p></li>
												<li class="divider-vertical"></li>
												<li><a href="login.php">Войти</a></li>
												<li class="divider-vertical"></li>
												<li><a href="registration.php">Регистрация</a></li>
												<li class="divider-vertical"></li>
											</ul>
											</form>
										</div> <!-- /.navbar-inner -->
									</div> <!-- /.navbar -->
								</div> <!-- /span12 -->
							</div> <!-- /row -->
                    <?php
                }
                else
                {
					switch(isLoggedIn("user_group")) {
						case "user":
							?>
							<div class="row navRow">
								<div class="span12">
									<div class="navbar">
										<div class="navbar-inner">
											<ul class="nav">
												<li class="add"><a href="index.php?action=add">Добавить новость</a></li>
												<li class="divider-vertical"></li>
												<li><a href="cabinet.php">Мой кабинет</a></li>
												<li class="divider-vertical"></li>
												<li><a href="get_app.php">Скачать приложение</a></li>
												<li class="divider-vertical"></li>
												<li><a href="logout.php">Выход</a></li>
												<li class="divider-vertical"></li>
												<li><p>Вы вошли как <?php echo isLoggedIn("username")?></p></li>
											</ul>
											</form>
										</div> <!-- /.navbar-inner -->
									</div> <!-- /.navbar -->
								</div> <!-- /span12 -->
							</div> <!-- /row -->
							<?php
							break;
						case "moderator":
							?>
							<div class="row navRow">
								<div class="span12">
									<div class="navbar">
										<div class="navbar-inner">
											<ul class="nav">
												<li class="add"><a href="index.php?action=add">Добавить новость</a></li>
												<li class="divider-vertical"></li>
												<li><a href="cabinet.php">Мой кабинет</a></li>
												<li class="divider-vertical"></li>
												<li><a href="moder.php">Кабинет модератора</a></li>
												<li class="divider-vertical"></li>
												<li><a href="get_app.php">Скачать приложение</a></li>
												<li class="divider-vertical"></li>
												<li><a href="logout.php">Выход</a></li>
												<li class="divider-vertical"></li>
												<li><p>Вы вошли как <?php echo isLoggedIn("username")?></p></li>
											</ul>
											</form>
										</div> <!-- /.navbar-inner -->
									</div> <!-- /.navbar -->
								</div> <!-- /span12 -->
							</div> <!-- /row -->
							
							<?php
							break;
						case "admin":
							?>
							<div class="row navRow">
								<div class="span12">
									<div class="navbar">
										<div class="navbar-inner">
											<ul class="nav">
												<li class="add"><a href="index.php?action=add">Добавить новость</a></li>
												<li class="divider-vertical"></li>
												<li><a href="cabinet.php">Мой кабинет</a></li>
												<li class="divider-vertical"></li>
												<li><a href="admin.php">Кабинет администратора</a></li>
												<li class="divider-vertical"></li>
												<li><a href="get_app.php">Скачать приложение</a></li>
												<li class="divider-vertical"></li>
												<li><a href="logout.php">Выход</a></li>
												<li class="divider-vertical"></li>
												<li><p>Вы вошли как <?php echo isLoggedIn("username")?></p></li>
											</ul>
										</div> <!-- /.navbar-inner -->
									</div> <!-- /.navbar -->
								</div> <!-- /span12 -->
							</div> <!-- /row -->
							<?php
							break;
						default: break;
					}
                    
                }
            ?>