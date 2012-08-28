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
	 * Initializes output page and sets up skin-specific parameters
	 * @param $out OutputPage object to initialize
	 */
	public function initPage( OutputPage $out ) {
		parent::initPage( $out );

		$out->addModuleScripts(  'skins.rainbow' );
		$out->addModuleMessages( 'skins.rainbow' );
		//$out->addModules( 'skins.rainbow' );
	}
	
	/**
	 * @param $out OutputPage object
	 */
	function setupSkinUserCss( OutputPage $out ){
		parent::setupSkinUserCss( $out );

		$out->addModuleStyles(   'skins.rainbow' );
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
		<span class="feature-description"><?php $this->msg( 'rainbow-jsmessage' ); ?></span>
		<div id="mw-js-message" style="display:none;"></div>
		
		<span class="feature-description"><?php $this->msg( 'rainbow-newtalk' ); ?></span>
		<?php if ( $this->data['newtalk'] )    { ?><div class="usermessage"><?php $this->html( 'newtalk' );    ?></div><?php } ?>
		<span class="feature-description"><?php $this->msg( 'rainbow-sitenotice' ); ?></span>
		<?php if ( $this->data['sitenotice'] ) { ?><div id="siteNotice"><?php     $this->html( 'sitenotice' ); ?></div><?php } ?>
		
		<span class="feature-description"><?php $this->msg( 'rainbow-sitename' ); ?></span>
		<?php $this->text( 'sitename' ); ?>
		
		<span class="feature-description"><?php $this->msg( 'rainbow-title' ); ?></span>
		<h1 id="firstHeading" class="firstHeading"><?php $this->html('title') ?></h1>
		<span class="feature-description"><?php $this->msg( 'rainbow-content' ); ?></span>
		<div id="content">
			<div id="bodyContent">
				<?php if ( $this->data['isarticle'] ): ?>
				<span class="feature-description"><?php $this->msg( 'rainbow-tagline' ); ?></span>
				<div id="siteSub"><?php $this->msg( 'tagline' ); ?></div>
				<?php endif; ?>
				
				<span class="feature-description"><?php $this->msg( 'rainbow-subtitle' ); ?></span>
				<?php if ( $this->data['subtitle'] ) { ?><div id="contentSub"><?php  $this->html( 'subtitle' ); ?></div><?php } ?>
				
				<span class="feature-description"><?php $this->msg( 'rainbow-undelete' ); ?></span>
				<?php if ( $this->data['undelete'] ) { ?><div id="contentSub2"><?php $this->html( 'undelete' ); ?></div><?php } ?>
				
				<span class="feature-description"><?php $this->msg( 'rainbow-bodytext' ); ?></span>
				<?php $this->html( 'bodytext' ) ?>
				
				<span class="feature-description"><?php $this->msg( 'rainbow-catlinks' ); ?></span>
				<?php $this->html( 'catlinks' ); ?>
			</div>
		</div>
		<span class="feature-description"><?php $this->msg( 'rainbow-dataAfterContent' ); ?></span>
		<?php $this->html( 'dataAfterContent' ); ?>
		
		<span class="feature-description"><?php $this->msg( 'rainbow-personaltools' ); ?></span>
		<ul>
		<?php 
			foreach ( $this->getPersonalTools() as $key => $item ) { 
				echo $this->makeListItem($key, $item); 
			}
		?>
		</ul>
		
		<span class="feature-description"><?php $this->msg( 'rainbow-contentnavigation' ); ?></span>
		<?php 
			foreach ( $this->data['content_navigation'] as $category => $tabs ) { 
				?> <ul>	<?php 
				foreach ( $tabs as $key => $tab ) { 
					echo $this->makeListItem( $key, $tab );
				}
				?> </ul> <?php 
			} 
		?>
		
		<span class="feature-description"><?php $this->msg( 'rainbow-sidebar' ); ?></span>
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
		
		<span class="feature-description"><?php $this->msg( 'rainbow-languageurls' ); ?></span>
		<?php if ( $this->data['language_urls'] ) { ?>
		<ul>
		<?php
			foreach ( $this->data['language_urls'] as $key => $langlink ) { ?>
				<?php echo $this->makeListItem( $key, $langlink ); ?>

		<?php
			} ?>
		</ul>
		<?php } ?>
		
		<span class="feature-description"><?php $this->msg( 'rainbow-toolbox' ); ?></span>
		<ul>
		<?php
			foreach ( $this->getToolbox() as $key => $tbitem ) { ?>
				<?php echo $this->makeListItem( $key, $tbitem ); ?>
		<?php
			}
			wfRunHooks( 'SkinTemplateToolboxEnd', array( &$this ) );
		?>
		</ul>
		
		<span class="feature-description"><?php $this->msg( 'rainbow-search' ); ?></span>
		<form action="<?php $this->text( 'wgScript' ); ?>">
			<input type='hidden' name="title" value="<?php $this->text( 'searchtitle' ) ?>" />
			<?php echo $this->makeSearchInput( array( 'type' => 'text' ) ); ?>
		</form>
		
		<span class="feature-description"><?php $this->msg( 'rainbow-footer' ); ?></span>
		<?php
		foreach ( $this->getFooterLinks() as $category => $links ) { ?>
		<ul>
		<?php
		foreach ( $links as $key ) { ?>
			<li><?php $this->html( $key ) ?></li>
		<?php } ?>
		</ul>
		<?php } ?>

		<?php global $wgUser; ?>
		<span class="feature-description"><?php $this->msg( 'rainbow-wikitextmsg', $wgUser->getName() ); ?></span>
		<?php $this->msgWiki( 'rainbow-wikitextmsg', $wgUser->getName() ); ?>

		<?php $this->printTrail(); ?>
	</body>
</html>
	<?php
		wfRestoreWarnings();
	}
}