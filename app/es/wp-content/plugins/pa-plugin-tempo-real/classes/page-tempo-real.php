<?php

	/* Template name: Tempo Real*/

	get_header();
	if(have_posts())
		the_post();
?>

<!-- *************************** -->
<!-- ********* Content ********* -->
<!-- *************************** -->
<section class="header-tempo-real">
	<div class="container iasd-tempo-real">
	<section class="row">
		<article class="entry-content">
			<div class="col-md-12">
				<header class="tempo-real-title">
					<h1><?php single_post_title(); ?></h1>
					<small><?php the_excerpt(); ?></small>
				</header>
			</div>
		</article>
	</section>
</div>
</section>

<!-- TRANSMITION -->
<div class="ng-app" ng-app="app" ng-controller="liveStreaming">
	<div ng-if="is_live">
		<div class="iasd-tempo-real streaming" >
			<div class="container">
				<section class="row player">
					<div class="col-md-12">
						<h1 class="titulo"><span ng-bind-html="titulo"></span></h1>
						<div class="embed-responsive embed-responsive-16by9 waiting-box">
							<iframe ng-src="{{player}}" frameborder="0" allowfullscreen></iframe>
						</div>
						<div ng-if="has_facebook" class="link_facebook"><p><a href="{{link_facebook}}" target="_blank">{{label_facebook}} Facebook</a></p></div>
					</div>
				</section>
			</div>
		</div>
	</div>
</div>

<!-- MINUTO A MINUTO -->
<div class="container iasd-tempo-real minute-minute">
	<section class="row">
		<article class="entry-content">
			<div class="col-md-8">
				<header>
					<h1 class="iasd-main-title"><?php the_field('24liveblog_titulo'); ?></h1>
				</header>

				<?php 
				if( get_field('status') == 'waiting' ) { ?>

					<p><?php _e( 'Cobertura ainda não começou.', 'iasd' ); ?></p>

				<?php }else if( (get_field('status') == 'live' || get_field('status') == 'finished')
					 && ! empty( get_field('24liveblog_ID') ) ) { ?>

					<?php if( have_rows('filters') ): ?>
					<div class="threads-filter">
						<ul class="marcadores list-inline">
							<li><p class="label"><?php the_field('filters_titulo'); ?></p></li>
							<?php while ( have_rows('filters') ) : the_row(); ?>
								<li><a href="<?php the_sub_field('text');?>"><?php the_sub_field('text');?><span>&times;</span></a></li>
							<?php endwhile; ?>
						</ul>
					</div>
					<?php endif; ?>
					<div id="LB24_LIVE_CONTENT" data-eid="<?php the_field('24liveblog_ID'); ?>"></div>
					<script src="https://v.24liveblog.com/24.js"></script>

					<!-- <div id="24lb_thread" class="lb_"></div>
					<script type="text/javascript">
					(function() {
					var lb24 = document.createElement('script'); 
						lb24.type = 'text/javascript'; 
						lb24.id = '24lbScript'; 
						lb24.async = true; 
						lb24.charset="utf-8";
						lb24.src = '//v.24liveblog.com/embed/24.js?id=<?php the_field('24liveblog_ID'); ?>';
					(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(lb24);})();
					</script> -->

				<?php }else{ ?>

					<p><?php _e( 'Sem informações neste momento.', 'iasd' ); ?></p>
					
				<?php } ?>

				<?php if ( comments_open() ) { ?>
				<section class="comments">
					<?php comments_template(); ?>
				</section>
				<?php } ?>
			</div>
		</article>
		<aside class="col-md-4 visible-md visible-lg iasd-aside">
			<?php dynamic_sidebar('news-real-time'); ?>
		</aside>
	</section>
</div>

<!-- RESUMO -->

<?php if( have_rows('resumo') ): ?>

	<div class="container iasd-tempo-real resuming">
		<div class="row">
			<div class="entry-content">
				<div class="col-md-8">
					<header>
						<h1 class="iasd-main-title"><?php _e( 'Resumos', 'iasd' ); ?></h1>
					</header>

					<?php while ( have_rows('resumo') ) : the_row(); ?>
				        <div class="resumo-item">
				        	<p class="tag"><?php the_sub_field('tax'); ?></p>
				        	<h2><?php the_sub_field('title'); ?></h2>
				        	<?php the_sub_field('content'); ?>
				        </div>
				    <?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>

<?php endif; ?>

<!-- *************************** -->
<!-- ******* End Content ******* -->
<!-- *************************** -->
<script type="text/javascript">
angular.module('app', ['ngSanitize'])
	.controller('liveStreaming', ['$scope', '$http', '$sce',
		function($scope, $http, $sce) {
			setInterval(function () {
				$http.get('<?php echo RealTimeController::JsonUrl(); ?>')
					.then(function(res){
						$data = res.data;
						$scope.live = $data.live;
						$scope.titulo = $data.titulo;
						$scope.youtube_id = $data.youtube_id;
						$scope.show_log = $data.show_log;
						$scope.facebook = $data.facebook;
						$scope.label_facebook = $data.label_facebook;
						$scope.link_facebook = $data.link_facebook;
						$scope.link_player = $data.link_player;

						if  ($scope.live == "1") {
							$scope.is_live = true	;
						} else {
							delete $scope.is_live;
						}

						if ($scope.facebook == "1") {
							$scope.has_facebook = true;
						} else {
							delete $scope.has_facebook;
						}

						// $scope.player = $sce.trustAsHtml('<div class="embed-responsive embed-responsive-16by9 waiting-box"><iframe src="https://www.youtube.com/embed/'+ $scope.youtube_id +'?autoplay=1" frameborder="0" allowfullscreen></iframe><div class="waiting-message"></div></div>');

						$scope.player = $sce.trustAsResourceUrl($scope.link_player);

						if ($scope.show_log == "1"){
							console.log("");
							console.log(Date());
							console.log("live: "+ $scope.live);
							console.log("is_live: "+ $scope.is_live);
							console.log("titulo: "+ $scope.titulo);
							console.log("youtube_id: "+ $scope.youtube_id);
							console.log("facebook: "+ $scope.facebook);
							console.log("has_facebook: "+ $scope.has_facebook);
							console.log("label_facebook: "+ $scope.label_facebook);
							console.log("link_facebook: "+ $scope.link_facebook);
							console.log("link_player: "+ $scope.link_player);
						}
					}
				);
			}, 3000);
	}
]);

</script>
<?php get_footer(); ?>