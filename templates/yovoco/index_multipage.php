<body class="<?php echo (($isFrontpage) ? ('front') : ('page')).' '.$active_alias.' '.$pageclass; ?>">
    <?php $pos='background'; ?>
    <?php if ($this->countModules($pos)): ?>
        <!-- <?php echo $pos; ?> -->
        <div class="<?php echo $pos; ?>">
            <jdoc:include type="modules" name="<?php echo $pos; ?>" style="none"/>
        </div>
    <?php endif;?>
    <nav class="navbar navbar-default navbar-fixed-top" id="main-nav">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#repomenu">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<!-- ======= LOGO ========-->
				<?php $pos='logo'; ?>
				<?php if ($this->countModules($pos)): ?>
					<!-- <?php echo $pos; ?> -->
					<div class="navbar-brand <?php echo $pos; ?>">
						<jdoc:include type="modules" name="<?php echo $pos; ?>" style="html5"/>
					</div>
				<?php endif;?>

			</div>

			<div class="collapse navbar-collapse" id="repomenu">
				<jdoc:include type="modules" name="menu"/>
				<jdoc:include type="modules" name="language"/>
				<jdoc:include type="modules" name="search" />
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

	<?php $pos='top'; ?>
    <?php if ($this->countModules($pos)): ?>
        <div class="container">
            <!-- <?php echo $pos; ?> -->
            <div class="row <?php echo $pos; ?>">
                <jdoc:include type="modules" name="<?php echo $pos; ?>" style="html5"/>
            </div><!-- div.row -->
        </div>
    <?php endif;?>

	<?php if (!$hidecontentwrapper) : ?>
		<div class="container">
			<!-- CONTENT -->
			<div class="contentwrapper">
				<div class="row">

					<?php $pos='sidebar-a'; ?>
					<?php if ($this->countModules($pos)): ?>
						<!-- <?php echo $pos; ?> -->
						<div class="<?php echo $sidebar_a; ?> <?php echo $pos; ?>">
							<div class="row">
								<jdoc:include type="modules" name="<?php echo $pos; ?>" style="html5"/>
							</div><!-- div.row -->
						</div><!-- .<?php echo $pos; ?> -->
					<?php endif;?>

					<div class="content <?php echo $contentclass; ?>">

						<?php $pos='inner-top'; ?>
						<?php if ($this->countModules($pos)): ?>
							<!-- <?php echo $pos; ?> -->
							<div class="row <?php echo $pos; ?>">
								<jdoc:include type="modules" name="<?php echo $pos; ?>" style="html5"/>
							</div><!-- div.row -->
						<?php endif;?>

						<?php if (!$showsystemoutput) : ?>
							<jdoc:include type="message" />
							<!-- Component Start -->
							<jdoc:include type="component" />
							<!-- Component End -->
						<?php endif; ?>

						<?php $pos='inner-bottom'; ?>
						<?php if ($this->countModules($pos)): ?>
							<!-- <?php echo $pos; ?> -->
							<div class="row <?php echo $pos; ?>">
								<jdoc:include type="modules" name="<?php echo $pos; ?>" style="html5"/>
							</div><!-- div.row -->
						<?php endif;?>

					</div><!-- .content -->

					<?php $pos='sidebar-b'; ?>
					<?php if ($this->countModules($pos)): ?>
						<!-- <?php echo $pos; ?> -->
						<div class="<?php echo $sidebar_b; ?> <?php echo $pos; ?>">
							<div class="row">
								<jdoc:include type="modules" name="<?php echo $pos; ?>" style="html5"/>
							</div><!-- div.row -->
						</div><!-- .<?php echo $pos; ?> -->
					<?php endif;?>

				</div><!-- div.row -->
			</div><!-- div.contentwrapper -->
		</div><!-- div.container -->
	<?php endif; ?>

	<?php $pos='bottom'; ?>
	<?php if ($this->countModules($pos)): ?>
        <div id="<?php echo $pos; ?>">
            <div class="container">
                <!-- <?php echo $pos; ?> -->
                <div class="row <?php echo $pos; ?>">
                    <jdoc:include type="modules" name="<?php echo $pos; ?>" style="html5"/>
                </div><!-- div.row -->
            </div>
        </div>
	<?php endif;?>



<footer>
	<?php $pos='footer'; ?>
	<?php if ($this->countModules($pos)): ?>
		<div class="container">
			<div class="row <?php echo $pos; ?>">
				<jdoc:include type="modules" name="<?php echo $pos; ?>" style="html5"/>
				<!-- End <?php echo $pos; ?> -->
			</div><!-- div.row -->
		</div>
	<?php endif;?>
</footer>