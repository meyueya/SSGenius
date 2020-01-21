<html>

<body>
				<div class="app-header header py-1 d-flex">
					<div class="container-fluid">
						<div class="d-flex">
							<a class="header-brand" href="#">
								
							</a>

							<a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
				
							<div class="d-flex order-lg-2 ml-auto">
								<div class="dropdown d-none d-md-flex mt-1" >
									<a  class="nav-link icon full-screen-link">
										<i class="fe fe-maximize floating"  id="fullscreen-button"></i>
									</a>
								</div>
								
								<div class="dropdown d-none d-md-flex mt-1">
									<a class="nav-link icon" data-toggle="dropdown">
										<i class="fe fe-mail floating"></i>
										<span class=" nav-unread badge badge-warning  badge-pill">2</span>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<a href="#" class="dropdown-item text-center">2 New Messages</a>
										<div class="dropdown-divider"></div>
										<a href="#" class="dropdown-item d-flex pb-3">
											<span class="avatar brround mr-3 align-self-center" style="background-image: url(../assets/images/faces/male/41.jpg)"></span>
											<div>
												<strong>Madeleine</strong> Hey! there I' am available....
												<div class="small text-muted">3 hours ago</div>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex pb-3">
											<span class="avatar brround mr-3 align-self-center" style="background-image: url(../assets/images/faces/female/1.jpg)"></span>
											<div>
												<strong>Anthony</strong> New product Launching...
												<div class="small text-muted">5  hour ago</div>
											</div>
										</a>
										<a href="#" class="dropdown-item d-flex pb-3">
											<span class="avatar brround mr-3 align-self-center" style="background-image: url(../assets/images/faces/female/18.jpg)"></span>
											<div>
												<strong>Olivia</strong> New Schedule Realease......
												<div class="small text-muted">45 mintues ago</div>
											</div>
										</a>
										<div class="dropdown-divider"></div>
										<a href="#" class="dropdown-item text-center">See all Messages</a>
									</div>
								</div>
						
								<div class="dropdown mt-1">
									<a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
										<span class="avatar avatar-md brround" style="background-image: url(<?php echo $user->picture; ?>)"></span>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow ">
										<div class="text-center">
											<a href="#" class="dropdown-item text-center font-weight-sembold user"><?php  echo " ". $user->short_name;?></a>
											<span class="text-center user-semi-title text-dark">Admin</span>
											<div class="dropdown-divider"></div>
										</div>
										<a class="dropdown-item" href="#">
											<i class="dropdown-icon mdi mdi-account-outline "></i> Profile
										</a>
										<a class="dropdown-item" href="#">
											<i class="dropdown-icon  mdi mdi-settings"></i> Settings
										</a>
										<a class="dropdown-item" href="#">
											<span class="float-right"><span class="badge badge-primary">6</span></span>
											<i class="dropdown-icon mdi  mdi-message-outline"></i> Inbox
										</a>
										<a class="dropdown-item" href="#">
											<i class="dropdown-icon mdi mdi-comment-check-outline"></i> Message
										</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">
											<i class="dropdown-icon mdi mdi-compass-outline"></i> Necesita ayuda?
										</a>
										<a class="dropdown-item" href="logout.php">
											<i class="dropdown-icon mdi  mdi-logout-variant"></i> Cerrar sesi&oacute;n
										</a>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<!-- Sidebar menu-->
				<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
				<aside class="app-sidebar ">
					<div class="app-sidebar__user">
						<div class="dropdown">
							<a class="nav-link p-0 leading-none d-flex" data-toggle="dropdown" href="#">
								<center><span class="avatar avatar-md ssg-logo"></span></center>
								<!--<span class="ml-2 "><span class="text-dark app-sidebar__user-name font-weight-semibold"><?php  echo " ".$user->short_name;?></span><br>
									<span class="text-muted app-sidebar__user-name text-sm"> Admin</span>
								</span>-->
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
								<a class="dropdown-item" href="#"><i class="dropdown-icon mdi mdi-account-outline"></i> Profile</a>
								<a class="dropdown-item" href="#"><i class="dropdown-icon mdi mdi-settings"></i> Settings</a>
								<a class="dropdown-item" href="#"><span class="float-right"><span class="badge badge-primary">6</span></span> <i class="dropdown-icon mdi mdi-message-outline"></i> Inbox</a>
								<a class="dropdown-item" href="#"><i class="dropdown-icon mdi mdi-comment-check-outline"></i> Message</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#"><i class="dropdown-icon mdi mdi-compass-outline"></i> Need help?</a>
								<a class="dropdown-item" href="login.html"><i class="dropdown-icon mdi mdi-logout-variant"></i> Sign out</a>
							</div>
						</div>
					</div>
					<ul class="side-menu">
						<li class="slide is-expanded">
							<a class="side-menu__item active" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-home"></i><span class="side-menu__label">MIS PÁGINAS</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">
							    <?php 
							    $isFirst = true;
							    if (isset($pages)){
							    foreach ($pages as $page){ 
							    ?>
								<li class="active"><a class="slide-item<?php echo $isFirst ? ' active' : ''; ?>" data-src="<?php echo $page['id_facebook_page']; ?>" href="#"><img src="https://graph.facebook.com/<?php echo $page['id_facebook_page']; ?>/picture"><div _ngcontent-c44="" class="ap-social-icon facebook"></div> <?php echo $page['name']; ?></a></li>
								<?php
								    $isFirst = false;
								    } 
								}?>
								<li><a class="slide-item" href="page.php?act=list">+ Añadir una página</a></li>
							</ul>
						</li>
						<li>
							<a class="side-menu__item" href="#"><i class="side-menu__icon fa fa-window-restore"></i><span class="side-menu__label">Catalogar</span></a>
						</li>
						<li class="slide">
							<a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-area-chart"></i><span class="side-menu__label">Reportes</span><i class="angle fa fa-angle-right"></i></a>
							<ul class="slide-menu">

								<li>
									<a href="#" class="slide-item">Reporte 1 </a>
								</li>
							</ul>
						</li>
						<li>
							<a class="side-menu__item" href="#"><i class="side-menu__icon fa fa-question-circle"></i><span class="side-menu__label">Ayuda & Soporte</span></a>
						</li>
					</ul>
				</aside>

</body>
</html>