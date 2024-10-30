<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.brosix.com
 * @since      1.0.0
 *
 * @package    Brosix_Livechat
 * @subpackage Brosix_Livechat/admin/partials
 */
?>

<?php
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

 if ( isset( $_POST['submit'] ) && isset( $_GET['nonce'] ) && wp_verify_nonce( $_GET['nonce'], 'brosix_postmail' ) ) {
	   $feedmail   = sanitize_email( $_POST["email"] );
	   $feedmessage   = sanitize_text_field( $_POST["message"] );
	 $headers = array('Content-Type: text/html; charset=UTF-8','Reply-To: '.$feedmail);
	 $mailcontent = 'From: '.$feedmail.'<br><br>'.'Feedback Message:<br>'.$feedmessage.'<br><br><br>This message was sent via Live Chat plugin by Brosix';
	$response = wp_mail( 'support@brosix.com', 'Live Chat Plugin Feedback', $mailcontent ,$headers );

if ( is_wp_error( $response ) ) {
   $error_message = $response->get_error_message();
   echo '<div class="alert warning">
		<input type="checkbox" id="alert3"/>
		<label class="close" title="close" for="alert3">
      <i class="icon-remove">x</i>
    </label>
		<div class="inner">
			Something went wrong:'.$error_message.'
		</div>
	</div>';
} else {
	 	echo	'<div class="alert info">
		<input type="checkbox" id="alert3"/>
		<label class="close" title="close" for="alert3">
      <i class="icon-remove">x</i>
    </label>
		<div class="inner">
			Thank you for your feedback!
		</div>
	</div>';
	}
 }
?>
<div class="brosix-chat-container">
	<h1>
		Brosix Live Chat 
	</h1>
<figure class="tabBlock">
  <ul class="tabBlock-tabs">
    <li class="tabBlock-tab is-active">Dashboard</li>
    <li class="tabBlock-tab">Tutorials</li>
    <li class="tabBlock-tab">Feedback</li>
  </ul>
  <div class="tabBlock-content">
    <div class="tabBlock-pane">
      	<div class="row hide-after-reg" style="<?php $chatID = get_brosix_chat_id(); if($chatID!=0){echo 'display:none;'; }?>">
		<div class="col col-md-10">
			<div class="card">
				<div  class="card-not-configured">
				<div class="register-icon"></div>
					Your site is NOT configured to use the Live Chat Widget yet.<br/> Enter your API key to start using it.
				</div>
			</div>
		</div>
		<div class="col col-md-4">
			<div class="card get-key-container">
					<a href="<?php echo $apiURL; ?>api-key/?site=<?php echo site_url(); ?>" id="get-api" target="_blank"><div>Get API Key</div></a>

			</div>
		</div>
		<div class="col col-md-6">
			<div class="card api-key-container">
					<input type="text" id="api-key" autocomplete="off" placeholder="Paste your API Key here.." <?php if(get_brosix_chat_api_key()){?>value="<?php echo get_brosix_chat_api_key(); ?>"<?php }?>>
					<a href="#" id="api-save">SAVE <div class="lds-hourglass"></div></a>
					
			</div>
		</div>
	</div>
		<div class="row admin-container" style="<?php $chatID = get_brosix_chat_id(); if($chatID==0){echo 'display:none;'; }?>">
		<div class="col col-md-5">
			<div class="card">
			<div class="chat-id">
				<h3>Network ID:</h3>
				<b id="chatID">	<?php 
				$chatID = get_brosix_chat_id();
				echo $chatID;
	?></b>
			</div>
			<div class="network-name">
				<h3>Network:</h3>
				<b id="networkName">
				<?php $chatNetwork = get_brosix_chat_network(); echo $chatNetwork; ?>
				</b>
			</div>
				<div class="tooltip network-switch" ><span class="tooltiptext">Change Network</span>
				</div>
		</div>
	</div>
		<div class="col col-md-4">
			<div class="card">
				<div class="livechat-status">
				<h3>
					Livechat Status:
				</h3>
				<b id="livechatStatus"> - </b>
			</div>
			<div class="chat-visibility">
				<h3>Show Live Chat Widget</h3>
				<b id="chatvisibility">
				<?php $chatStatus = get_brosix_chat_status();
					if($chatStatus ==1){
						echo 'Enabled';
					}else{
						echo 'Disabled';
					}
				 ?>
				</b>
				<label class="switch">
				  <input id="chatstatus" type="checkbox"<?php $chatStatus = get_brosix_chat_status();
					if($chatStatus ==1){ echo 'checked';} ?>></input>
				  <span class="slider round"></span>
				<div class="tooltip network-warning"><span class="tooltiptext">Enable Chat Widget from the Brosix Control Panel</span>
				</div>
				</label>
				<div class="home-visibility">
					<label for="homestatus">Hide on Home </label><input id="homestatus" type="checkbox"<?php $homeStatus = get_brosix_home_status();
					if($homeStatus ==1){ echo 'checked';} ?>></input>
				</div>
				<small>
				Show or hide the Live Chat widget from your website.
				</small>
			</div>
		</div>
		</div>
		<div class="col col-md-9">
					<div class="card card-properly-configured" style="margin-top:-5px;">
			<div class="customize-chat-text">
				<div class="ok-icon"></div>
				Your site is properly configured to use the Live Chat Widget.</br> Click the "Customize" button to customize it.
			</div>
			<a href="<?php echo $apiURL; ?>?site=<?php echo home_url(); ?>" class="customize-chat" target="_blank"><i class="customize-icon"></i>Customize</a>
					</div>
		</div>
			<div class="col col-md-3 cta-front">
			<div class="card card-highlight ">
				<div class="brosix-logo"></div>
				<h3>
				An all-in-one, secure instant messenger
				</h3>
				<a href="https://www.brosix.com/features/" target="_blank">Learn more</a>
			</div>
		</div>
	<div class="col col-md-12">
		<div class="card card-features">
			<div>
				<div class="question-icon"></div>
				<strong>Did you know? Brosix offers more than just a Live Chat!</strong>
			</div>
			<div class="features-desc">
				Brosix is a comprehensive team communication tool that provides users with their very own private and fully secure networks. Brosix networks include:
				<div class="row">
				<div class="col col-md-6">
				<h4>
				Communication and Collaboration features:
				</h4>
				<div class="features-list">
					<b>Multiple Live Chat Operators</b>
					<b>Collaboration features between your operators</b>
					<b>Dedicated Chat Rooms for team collaboration</b>
					<b>Unlimited file transfer</b>
					<b>Screen-sharing</b>
					<b>Screenshot</b>
					<b>Audio/Video Calls</b>
					<b>Virtual whiteboard</b>
					<b>Co-Browsing</b>
				</div>
				</div>
				<div class="col col-md-6">
				<h4>
				Network Administration and management features:
				</h4>
				<div class="features-list">
					<b>Manage user accounts</b>
					<b>Enable/Disable features</b>
					<b>User Activity Log</b>
				</div>
				<h4>
				Security features:
				</h4>
				<div class="features-list">
					<b>End to end encryption of all communication channels</b>
					<b>Secure server hosting</b>
					<b>Control over network users</b>
				</div>
				</div>
				<div class="col col-md-6">
				<div class="features-list">
				<a href="https://www.brosix.com/features/" target="_blank">Check all features!</a>
				</div>
				</div>
				</div>
			</div>
			
		</div>
		
		</div>
	</div>
    </div>
   <div class="tabBlock-pane">
	<div class="row">
	   <h2>
		  Our latest tutorials to help you get started with Brosix Live chat
	   </h2>
		<div class="col col-md-9">
		<div class="row">
			<?php if(function_exists('fetch_feed')) {
 
    include_once(ABSPATH.WPINC.'/feed.php');
    $feed = fetch_feed('https://www.brosix.com/feed/tutorials/');
    $limit = $feed->get_item_quantity(9); // specify number of items
    $items = $feed->get_items(0, $limit); // create an array of items
 
}
if ($limit == 0) echo '<div>The feed is either empty or unavailable.</div>';
else foreach ($items as $item) : ?>
<div class="col col-md-4">
<div class="card rss">
<a href="<?php echo $item->get_permalink(); ?>"
      title="<?php echo $item->get_title(); ?>" target="_blank">
	<?php $enclosure = $item->get_enclosure();
	if ($enclosure->get_link())
{
   echo "<img src=\"" . $enclosure->get_link() . "\">";
} ?>

			<div class="rss-title">
				<?php echo $item->get_title(); ?>
			</div>
	 </a>	
 </div>
</div>
<?php endforeach; ?>
			</div></div>
		<div class="col col-md-3">
			<div class="card card-highlight cta-blog">
				<div class="flash"></div>
				<h3>
				Learn how to manage your Remote Work team 
				</h3>
				<a href="https://www.brosix.com/blog/category/remote-work/" target="_blank">with our free resources</a>
			</div>
		</div>
	</div>
    </div>
   <div class="tabBlock-pane">
      
	<div class="row">
		<div class="col col-md-6">
		<div class="card feedback-form-card">
						<h4 class="feedback-title">
				Do you need help with the plugin or have ideas to improve it?
			</h4>
			<?php 
			 $url = add_query_arg(
            [
                'nonce'  => wp_create_nonce( 'brosix_postmail' ),
            ], $_SERVER['REQUEST_URI']
        );
			?>
			<form id="feedback" action="<?php echo esc_url($url); ?>" method="post">
<div class="row">
<div class="col-md-12">
<input class="email" id="email" type="email" name="email" placeholder="Email address" value="" required="">
<p><textarea class="textarea" name="message" id="message" rows="3" placeholder="How may we help you?" required=""></textarea></p></div>
<div class="col-md-12">
<input id="requiredmail" class="check" type="checkbox" required=""><label for="requiredmail">I agree that by clicking the send button below my email address and comments will be sent to a Brosix server.</label>
<input class="btn btn-feedback" name="submit" type="submit" value="Send">
</div>
</div>
</form>
			</div></div>
		<div class="col col-md-6">
			<div class="feedback-right card row">
			<a class="col col-md-12" target="_blank" href="http://twitter.com/share?text=Hey, im using this amazing Live Chat plugin by @Brosix&url=https://www.brosix.com&hashtags=brosix,livechat"><div class="card twitter">
			<div class="twitter-icon"></div> Tweet about us
			</div></a>
			<a class="col col-md-12" target="_blank" href="https://www.facebook.com/sharer.php?u=https://www.facebook.com/brosix/" onclick="window.open(this.href, 'facebookwindow','left=20,top=20,width=600,height=700,toolbar=0,resizable=1'); return false;"><div class="card facebook">
			<div class="facebook-icon"></div> Recommend us
			</div></a>
			<a class="col col-md-12" target="_blank" href="https://wordpress.org/plugins/brosix-live-chat/"><div class="card wordpress">
			<div class="wordpress-icon"></div> Rate our plugin
			</div></a>
		</div>
		</div>
	</div>
    </div>
  </div>
</figure>

		<div class="alert info save-first-time-id" style="display:none;">
		<input type="checkbox" id="alert3"/>
		<label class="close" title="close" for="alert3">
      <i class="icon-remove">x</i>
    </label>
		<div class="inner">
			Your network has been saved. Enable Live Chat visibility to start chatting with your visitors!
		</div>
	</div>
	<div class="alert warning wrong-api-key">
		<input type="checkbox" id="alert4"/>
		<label class="close" title="close" for="alert4">
      <i class="icon-remove">x</i>
    </label>
		<div class="inner">
				Incorrect API Key. Please copy the full API Key and try again.
	</div>
	</div>
	
	<div class="alert success is-live">
		<input type="checkbox" id="alert3"/>
		<div class="inner">
			Your Live Chat widget is VISIBLE!
		</div>
	</div>
	<div class="alert error is-hidden">
		<input type="checkbox" id="alert3"/>
		<div class="inner">
			Your Live Chat widget is HIDDEN!
		</div>
	</div>
</div>