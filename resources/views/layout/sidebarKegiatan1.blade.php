			<div id="sidebar" class="sidebar responsive ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>
						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>
						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>
						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>
						<span class="btn btn-info"></span>
						<span class="btn btn-warning"></span>
						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class=" ">
						<a href="{{route('opdkegiatan1')}}">
							<i class="menu-icon fa fa-home"></i>
							<span class="menu-text"> Home </span>
						</a>
						<b class="arrow"></b>
					</li>
<!--
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-th-list"></i>
							<span class="menu-text"> Administrasi </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Ganti Password
								</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
-->
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-th-list"></i>
							<span class="menu-text">
								Pengelolaan Risiko
							</span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
									<a href="{{route('identifikasikegiatan1.index')}}">
										<i class="menu-icon fa fa-caret-right"></i>
										Identifikasi Risiko OPD Kegiatan
									</a>
								<b class="arrow"></b>
							</li>
							<li class="">
									<a href="{{route('analisiskegiatan1.index')}}">
										<i class="menu-icon fa fa-caret-right"></i>
										Analisis &amp; Evaluasi Risiko OPD Kegiatan
									</a>
								<b class="arrow"></b>
							</li>
							<li class="">
									<a href="{{route('rtpkegiatan1.index')}}">
										<i class="menu-icon fa fa-caret-right"></i>
										Rencana Tindak Pengendalian OPD Kegiatan
									</a>
								<b class="arrow"></b>
							</li>
						</ul>
					</li>
<!--
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-th-list"></i>
							<span class="menu-text"> Referensi </span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Peraturan
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Pedoman
								</a>
								<b class="arrow"></b>
							</li>
							<li class="">
								<a href="#">
									<i class="menu-icon fa fa-caret-right"></i>
									Lain - lain
								</a>
								<b class="arrow"></b>
							</li>

-->							
						</ul>
					</li>
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>
			</div>