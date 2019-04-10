		</div><!-- /.container -->

<?php get_sidebar(); ?>
	</div>
</div>

<footer class="container-fluid">

	<div class="row justify-content-center">

		<div class="col-xl-6 col-lg-8 col-md-9 col-sm-11 col-11 blog-footer">

			<div class="row">

				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">

					<p>Template built for <a href="<?php echo get_bloginfo( 'wpurl' );?>"><?php echo get_bloginfo( 'name' ); ?></a> <br>by <a href="http://jimmyontheroad.online">Jimmy On The Road</a>.</p>

				</div>

				<div class="col-xl-6 col-lg-6 col-md-12col-sm-12 col-12">

					<p>© <?php echo str_replace('www.','', $_SERVER['SERVER_NAME']);?> 2019<br>Tous droits réservés.</p>
					
				</div>
			</div>
		</div>
	</div>
</footer>

 <?php wp_footer(); ?>

	</body>
</html>