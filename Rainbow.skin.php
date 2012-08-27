<?php
/**
* Skin file for skin Rainbow.
*
* @file
* @ingroup Skins
*/

/**
 * SkinTemplate class for Rainbow skin
 * @ingroup Skins
 */
class SkinRainbow extends SkinTemplate {

	var $skinname       = 'Rainbow';
	var $stylename      = 'Rainbow';
	var $template       = 'RainbowTemplate';
	var $useHeadElement = true;

	/**
	 * @param $out OutputPage object
	 */
	function setupSkinUserCss( OutputPage $out ){
		parent::setupSkinUserCss( $out );
		$out->addModuleStyles( "skins.Rainbow" );
	}

}

/**
 * BaseTemplate class for Rainbow skin
 * @ingroup Skins
 */
class RainbowTemplate extends BaseTemplate {

	/**
	 * Outputs the entire contents of the page
	 */
	public function execute() {
		//MW 1.18.x compatibility
		if ( !isset($this->data['sitename']) ) {
			global $wgSitename;
			$this->set( 'sitename', $wgSitename );
		}
		
		wfSuppressWarnings(); // Suppress warnings to prevent notices about missing indexes in $this->data

		$this->html( 'headelement' );
?>

		<div id="mw-js-message" style="display:none;"></div>
		<?php if ( $this->data['newtalk'] )    { ?><div class="usermessage"><?php $this->html( 'newtalk' );    ?></div><?php } ?>
		<?php if ( $this->data['sitenotice'] ) { ?><div id="siteNotice"><?php     $this->html( 'sitenotice' ); ?></div><?php } ?>

		<?php $this->text( 'sitename' ); ?>
		
		<?php $this->html( 'title' ); ?>
		<h1 id="firstHeading" class="firstHeading"><?php $this->html('title') ?></h1>
		<div id="content">
			<div id="bodyContent">
				<?php if ( $this->data['isarticle'] ): ?>
				<div id="siteSub"><?php $this->msg( 'tagline' ); ?></div>
				<?php endif; ?>
				
				<?php if ( $this->data['subtitle'] ) { ?><div id="contentSub"><?php  $this->html( 'subtitle' ); ?></div><?php } ?>
				<?php if ( $this->data['undelete'] ) { ?><div id="contentSub2"><?php $this->html( 'undelete' ); ?></div><?php } ?>
				
				<?php $this->html( 'bodytext' ) ?>
				
				<?php $this->html( 'catlinks' ); ?>
			</div>
		</div>
		<?php $this->html( 'dataAfterContent' ); ?>
		
		<ul>
		<?php 
			foreach ( $this->getPersonalTools() as $key => $item ) { 
				echo $this->makeListItem($key, $item); 
			}
		?>
		</ul>
		
		<?php 
			foreach ( $this->data['content_navigation'] as $category => $tabs ) { 
				?> <ul>	<?php 
				foreach ( $tabs as $key => $tab ) { 
					echo $this->makeListItem( $key, $tab );
				}
				?> </ul> <?php 
			} 
		?>
		
		<?php
			foreach ( $this->getSidebar() as $boxName => $box ) {
				?> 
					<div id="<?php echo Sanitizer::escapeId( $box['id'] ) ?>"<?php echo Linker::tooltip( $box['id'] ) ?>>
					<h5><?php echo htmlspecialchars( $box['header'] ); ?></h5>
				<?php
				if ( is_array( $box['content'] ) ) { ?>
				<ul>
			<?php
					foreach ( $box['content'] as $key => $item ) { ?>
					<?php echo $this->makeListItem( $key, $item ); ?>

			<?php
					} ?>
				</ul>
			<?php
				} else { ?>
					<?php echo $box['content']; ?>
			<?php
				} ?>
			<?php
			}
		?>
		
		<?php if ( $this->data['language_urls'] ) { ?>
		<ul>
		<?php
			foreach ( $this->data['language_urls'] as $key => $langlink ) { ?>
				<?php echo $this->makeListItem( $key, $langlink ); ?>

		<?php
			} ?>
		</ul>
		<?php } ?>
			
		<ul>
		<?php
			foreach ( $this->getToolbox() as $key => $tbitem ) { ?>
				<?php echo $this->makeListItem( $key, $tbitem ); ?>
		<?php
			}
			wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this ) );
		?>
		</ul>
			
		<form action="<?php $this->text( 'wgScript' ); ?>">
			<input type='hidden' name="title" value="<?php $this->text( 'searchtitle' ) ?>" />
			<?php echo $this->makeSearchInput( array( 'type' => 'text' ) ); ?>
		</form>
		
			<h2>Footer Links</h2>
		<?php
		foreach ( $this->getFooterLinks() as $category => $links ) { ?>
		<ul>
		<?php
		foreach ( $links as $key ) { ?>
			<li><?php $this->html( $key ) ?></li>
		<?php } ?>
		</ul>
		<?php } ?>
			
		<?php $this->msg( 'rainbow-welcome-notification' ); ?>
		<?php $this->msgWiki( 'rainbow-key' ); ?>

		<?php $this->printTrail(); ?>
	</body>
</html>
	<?php
		wfRestoreWarnings();
	}
}