
								<div class="channel-tab-content channel-layout-two-column selected blogger-template">
									<div class="tab-content-body">
										<div class="primary-pane">
                                            <div class="channel-activity-feeds " data-module-id="10500">
                                                <div class="activity-feeds-container">
                                                    <div class="activity-feeds-header clearfix">
                                                        <ul>
                                                            <li class="user-feed-filter selected">
                                                                <a href="/user/<?php echo htmlspecialchars($_user['username']); ?>/feed?filter=2">
                                                                Activity
                                                                </a>
                                                            </li>

															<li class="user-feed-filter">
                                                                <a href="/user/<?php echo htmlspecialchars($_user['username']); ?>/discussion">
                                                                Profile Comments
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div id="channel-feed-post-form">
                                                    </div>
                                                    <div class="yt-horizontal-rule channel-section-hr"><span class="first"></span><span class="second"></span><span class="third"></span></div>
                                                    <div class="activity-feed">
                                                        <div class="feed-list-container">
                                                            <div class="feed-item-list">
                                                                <div>
                                                                    <?php 
                                                                        $stmt = $__db->prepare("select 
																		t1.date, 
																		t1.comment, 
																		t1.author, 
																		t1.id,
																		t1.toid
																	  FROM 
																		`comments` as t1 
																	  WHERE
																		t1.author = :comment_username
																	  UNION ALL 
																	  select 
																		t2.publish, 
																		t2.description, 
																		t2.author, 
																		t2.rid,
																		t2.visibility
																	  FROM 
																		`videos` as t2
																	  WHERE
																		t2.author = :videos_username
																	  ORDER BY 
																		`date` DESC LIMIT 10;");
                                                                        $stmt->bindParam(":comment_username", $_user['username']);
																		$stmt->bindParam(":videos_username", $_user['username']);
                                                                        $stmt->execute();
																		if($stmt->rowCount() == 0) { echo "<br><span style='color:grey;font-size:11px;'>This user has not done anything yet.</span>"; }
                                                                        while($content = $stmt->fetch(PDO::FETCH_ASSOC)) { 
																			if((int)$content['id']) {
																				$content = $__video_h->fetch_comment_id($content['id']);
																				$content['video'] = $__video_h->fetch_video_rid($content['toid']);
																				$content['type'] = "comment";
																			} else {
																				$content = $__video_h->fetch_video_rid($content['id']);
																				$content['type'] = "video";
																			}

																			if($content['type'] == "video") {
                                                                    ?>
                                                                    <div class="feed-item-container" data-channel-key="UCc6W7efUSkd9YYoxOnctlFg">
                                                                        <a href="/user/<?php echo htmlspecialchars($content['author']); ?>?feature=plcp" class="feed-author-bubble " title="<?php echo htmlspecialchars($content['author']); ?>">  <span class="feed-item-author">
                                                                        <span class="video-thumb ux-thumb yt-thumb-square-28 "><span class="yt-thumb-clip"><span class="yt-thumb-clip-inner"><img src="http://s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="<?php echo htmlspecialchars($content['author']); ?>" data-thumb="/dynamic/pfp/<?php echo $__user_h->fetch_pfp($content['author']); ?>" width="28"><span class="vertical-align"></span></span></span></span>
                                                                        </span>
                                                                        </a>
                                                                        <div class="feed-item-main">
                                                                            <div class="feed-item-header">
                                                                                <span class="feed-item-actions-line ">
                                                                                <span class="feed-item-owner">    <a href="/user/<?php echo htmlspecialchars($content['author']); ?>?feature=plcp" class="yt-user-name " dir="ltr"><?php echo htmlspecialchars($content['author']); ?></a>
                                                                                </span>
                                                                                uploaded a video
                                                                                <span class="feed-item-time">
                                                                                <?php echo $__time_h->time_elapsed_string($content['publish']); ?>
                                                                                </span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="feed-item-content-wrapper clearfix">
                                                                                <div class="feed-item-thumb">
                                                                                    <a class="ux-thumb-wrap contains-addto  yt-uix-contextlink  yt-uix-sessionlink" data-sessionlink="context=C48232d5ADvjVQa1PpcFMDeAifI2yCLsflFJ-7L8wLgQIeQbQxzjo%3D" href="/watch?v=<?php echo htmlspecialchars($content['rid']); ?>&amp;feature=plcp">
                                                                                    <span class="video-thumb ux-thumb yt-thumb-default-185 "><span class="yt-thumb-clip"><span class="yt-thumb-clip-inner"><img src="http://s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="Thumbnail" onerror="this.onerror=null;this.src='/dynamic/thumbs/default.jpg';" data-thumb="/dynamic/thumbs/<?php echo htmlspecialchars($content['thumbnail']); ?>" width="185"><span class="vertical-align"></span></span></span></span>
                                                                                    <span class="video-time"><?php echo $__time_h->timestamp($content['duration']); ?></span>
                                                                                    <button onclick=";return false;" title="Watch Later" type="button" class="addto-button video-actions addto-watch-later-button-sign-in yt-uix-button yt-uix-button-default yt-uix-button-short yt-uix-tooltip" data-button-menu-id="shared-addto-watch-later-login" data-video-ids="<?php echo htmlspecialchars($content['rid']); ?>" role="button"><span class="yt-uix-button-content">  <img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="Watch Later">
                                                                                    </span><img class="yt-uix-button-arrow" src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt=""></button>
                                                                                    </a>
                                                                                </div>
                                                                                <div class="feed-item-content">
                                                                                    <h4>
                                                                                        <a class="feed-video-title title yt-uix-contextlink  yt-uix-sessionlink" href="/watch?v=<?php echo htmlspecialchars($content['rid']); ?>&amp;feature=plcp" data-sessionlink="feature=plcp&amp;context=C48232d5ADvjVQa1PpcFMDeAifI2yCLsflFJ-7L8wLgQIeQbQxzjo%3D">
                                                                                        <?php echo htmlspecialchars($content['title']); ?>
                                                                                        </a>
                                                                                    </h4>
                                                                                    <div class="metadata">
                                                                                        <span class="view-count">
                                                                                        <?php echo $__video_h->fetch_video_views($content['rid']); ?> views
                                                                                        </span>
                                                                                        <div class="description">
                                                                                            <p><?php echo $__video_h->shorten_description($content['description'], 100, true); ?></p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="feed-item-dismissal-notices">
                                                                        <div class="feed-item-dismissal feed-item-dismissal-hide hid">This item has been hidden</div>
                                                                        <div class="feed-item-dismissal feed-item-dismissal-uploads hid">In the future you will only see uploads from   <span class="feed-item-owner">    <a href="/user/<?php echo htmlspecialchars($content['author']); ?>?feature=plcp" class="yt-user-name " dir="ltr"><?php echo htmlspecialchars($content['author']); ?></a>
                                                                            </span>
                                                                        </div>
                                                                        <div class="feed-item-dismissal feed-item-dismissal-all-activity hid">In the future you will see all activity from   <span class="feed-item-owner">    <a href="/user/<?php echo htmlspecialchars($content['author']); ?>?feature=plcp" class="yt-user-name " dir="ltr"><?php echo htmlspecialchars($content['author']); ?></a>
                                                                            </span>
                                                                        </div>
                                                                        <div class="feed-item-dismissal feed-item-dismissal-unsubscribe hid">You have been unsubscribed from   <span class="feed-item-owner">    <a href="/user/<?php echo htmlspecialchars($content['author']); ?>?feature=plcp" class="yt-user-name " dir="ltr"><?php echo htmlspecialchars($content['author']); ?></a>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                    <div>
                                                                        <div class="feed-item-dismissal-notices">
                                                                        <div class="feed-item-dismissal feed-item-dismissal-hide hid">This item has been hidden</div>
                                                                        <div class="feed-item-dismissal feed-item-dismissal-uploads hid">In the future you will only see uploads from   <span class="feed-item-owner">    <a href="/user/<?php echo htmlspecialchars($content['author']); ?>?feature=plcp" class="yt-user-name " dir="ltr"><?php echo htmlspecialchars($content['author']); ?></a>
                                                                            </span>
                                                                        </div>
                                                                        <div class="feed-item-dismissal feed-item-dismissal-all-activity hid">In the future you will see all activity from   <span class="feed-item-owner">    <a href="/user/<?php echo htmlspecialchars($content['author']); ?>?feature=plcp" class="yt-user-name " dir="ltr"><?php echo htmlspecialchars($content['author']); ?></a>
                                                                            </span>
                                                                        </div>
                                                                        <div class="feed-item-dismissal feed-item-dismissal-unsubscribe hid">You have been unsubscribed from   <span class="feed-item-owner">    <a href="/user/<?php echo htmlspecialchars($content['author']); ?>?feature=plcp" class="yt-user-name " dir="ltr"><?php echo htmlspecialchars($content['author']); ?></a>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <?php } else { 
																		if($__video_h->video_exists($content['video']['rid'])) { ?>
																	<div class="feed-item-container" data-channel-key="UCXf1X2u5gsmuqcuTQlpOGhw">
																		<a href="/user/<?php echo htmlspecialchars($content['author']); ?>?feature=plcp" class="feed-author-bubble " title="<?php echo htmlspecialchars($content['author']); ?>">  <span class="feed-item-author">
																		<span class="video-thumb ux-thumb yt-thumb-square-28 "><span class="yt-thumb-clip"><span class="yt-thumb-clip-inner"><img src="http://s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="<?php echo htmlspecialchars($content['author']); ?>" data-thumb="/dynamic/pfp/<?php echo $__user_h->fetch_pfp($content['author']); ?>" width="28"><span class="vertical-align"></span></span></span></span>
																		</span>
																		</a>
																		<div class="feed-item-main">
																			<div class="feed-item-header">
																				<span class="feed-item-actions-line ">
																					<span class="feed-item-owner">    <a href="/user/<?php echo htmlspecialchars($content['author']); ?>?feature=plcp" class="yt-user-name " dir="ltr"><?php echo htmlspecialchars($content['author']); ?></a>
																					</span>
																					<a href="/watch?v=<?php echo htmlspecialchars($content['video']['rid']); ?>">commented</a>
																					<span class="feed-item-time">
																					<?php echo $__time_h->time_elapsed_string($content['video']['publish']); ?>
																					</span>
																					<div class="feed-item-post">
																						<p><?php echo $__video_h->shorten_description($content['comment'], 100, true); ?></p>
																					</div>
																				</span>
																			</div>
																			<div class="feed-item-content-wrapper clearfix">
																				<div class="feed-item-thumb">
																					<a class="ux-thumb-wrap contains-addto  yt-uix-contextlink  yt-uix-sessionlink" data-sessionlink="context=C4bdbfd8ADvjVQa1PpcFOc8xrGFVc9o98fEYoP4zkJyb88FUqz-7k%3D" href="/watch?v=<?php echo htmlspecialchars($content['video']['rid']); ?>">
																					<span class="video-thumb ux-thumb yt-thumb-default-106 "><span class="yt-thumb-clip"><span class="yt-thumb-clip-inner"><img src="http://s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="Thumbnail" onerror="this.onerror=null;this.src='/dynamic/thumbs/default.jpg';" data-thumb="/dynamic/thumbs/<?php echo htmlspecialchars($content['video']['thumbnail']); ?>" width="106"><span class="vertical-align"></span></span></span></span>
																					<span class="video-time"><?php echo $__time_h->timestamp($content['video']['duration']); ?></span>
																					<button onclick=";return false;" title="Watch Later" type="button" class="addto-button video-actions addto-watch-later-button-sign-in yt-uix-button yt-uix-button-default yt-uix-button-short yt-uix-tooltip" data-button-menu-id="shared-addto-watch-later-login" data-video-ids="-DWfIzMgZEY" role="button"><span class="yt-uix-button-content">  <img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="Watch Later">
																					</span><img class="yt-uix-button-arrow" src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt=""></button>
																					</a>
																				</div>
																				<div class="feed-item-content">
																					<h4>
																						<a class="feed-video-title title yt-uix-contextlink  yt-uix-sessionlink secondary" href="/watch?v=<?php echo htmlspecialchars($content['video']['rid']); ?>" data-sessionlink="feature=plcp&amp;context=C4bdbfd8ADvjVQa1PpcFOc8xrGFVc9o98fEYoP4zkJyb88FUqz-7k%3D">
																						<?php echo htmlspecialchars($content['video']['title']); ?>
																						</a>
																					</h4>
																					<div class="metadata">
																						<a href="/user/<?php echo htmlspecialchars($content['video']['author']); ?>?feature=plcp" class="yt-user-photo ">
																						<span class="video-thumb ux-thumb yt-thumb-square-18 "><span class="yt-thumb-clip"><span class="yt-thumb-clip-inner"><img src="http://s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="<?php echo htmlspecialchars($content['video']['author']); ?>" data-thumb="/dynamic/pfp/<?php echo $__user_h->fetch_pfp($content['video']['author']); ?>" width="18"><span class="vertical-align"></span></span></span></span>
																						</a>
																						<a href="/user/<?php echo htmlspecialchars($content['video']['author']); ?>?feature=plcp" class="yt-user-name " dir="ltr"><?php echo htmlspecialchars($content['video']['author']); ?></a>
																						<span class="bull">•</span>
																						<span class="view-count">
																						<?php echo $__video_h->fetch_video_views($content['video']['rid']); ?> views
																						</span>
																						<div class="description">
																							<p><?php echo $__video_h->shorten_description($content['video']['description'], 50, true); ?></p>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	<?php } } } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										<div class="secondary-pane">
										<div id="watch-longform-ad" style="display:none;">
												<div id="watch-longform-text">
													Advertisement
												</div>
												<div id="watch-longform-ad-placeholder"><img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" width="300" height="60"></div>
												<div id="instream_google_companion_ad_div"></div>
											</div>
											<div id="watch-channel-brand-div" class="companion-ads has-visible-edge channel-module yt-uix-c3-module-container hid">
												<div id="ad300x250"></div>
												<div id="google_companion_ad_div"></div>
												<div class="ad-label-text">
													Advertisement
												</div>
											</div>
											<div class="user-profile channel-module yt-uix-c3-module-container ">
												<div class="module-view profile-view-module" data-owner-external-id="IwFjwMjI0y7PDBVEO9-bkQ">
													<h2>About <?php echo htmlspecialchars($_user['username']); ?></h2>
													<div class="section first">
														<div class="user-profile-item profile-description">
															<p><?php echo $__video_h->shorten_description($_user['bio'], 5000); ?></p>
														</div>
														<div class="user-profile-item">
														</div>
														<div class="user-profile-item">
                                                            <!--
															<div class="yt-c3-profile-custom-url field-container ">
																<a href="http://smarturl.it/boyfriend?IQid=youtube" rel="me nofollow" target="_blank" title="Get &quot;Boyfriend&quot; on iTunes" class="yt-uix-redirect-link">
																<img src="//s2.googleusercontent.com/s2/favicons?domain=smarturl.it&amp;feature=youtube_channel" class="favicon" alt="">
																<span class="link-text">
																Get "Boyfriend" on iTunes
																</span>
																</a>
															</div>
															<div class="yt-c3-profile-custom-url field-container ">
																<a href="http://bieberfever.com/" rel="me nofollow" target="_blank" title="Bieber Fever" class="yt-uix-redirect-link">
																<img src="//s2.googleusercontent.com/s2/favicons?domain=bieberfever.com&amp;feature=youtube_channel" class="favicon" alt="">
																<span class="link-text">
																Bieber Fever
																</span>
																</a>
															</div>
                                                            -->
														</div>
														<hr class="yt-horizontal-rule ">
													</div>
													<?php if(!empty($_user['website'])) { ?>
														<div class="user-profile-item">
															<div class="yt-c3-profile-custom-url field-container ">
																<a href="<?php echo addhttp(htmlspecialchars($_user['website'])); ?>" rel="me nofollow" target="_blank" title="<?php echo htmlspecialchars($_user['website']); ?>" class="yt-uix-redirect-link">
																<img src="/yt/imgbin/custom_site.png" class="favicon" alt="">
																<span class="link-text">
																<?php echo htmlspecialchars($_user['website']); ?>
																</span>
																</a>
															</div>
														</div>
														<div class="user-profile-item">
															<!--
															<div class="yt-c3-profile-custom-url field-container ">
																<a href="http://smarturl.it/boyfriend?IQid=youtube" rel="me nofollow" target="_blank" title="Get &quot;Boyfriend&quot; on iTunes" class="yt-uix-redirect-link">
																<img src="//s2.googleusercontent.com/s2/favicons?domain=smarturl.it&amp;feature=youtube_channel" class="favicon" alt="">
																<span class="link-text">
																Get "Boyfriend" on iTunes
																</span>
																</a>
															</div>
															<div class="yt-c3-profile-custom-url field-container ">
																<a href="http://bieberfever.com/" rel="me nofollow" target="_blank" title="Bieber Fever" class="yt-uix-redirect-link">
																<img src="//s2.googleusercontent.com/s2/favicons?domain=bieberfever.com&amp;feature=youtube_channel" class="favicon" alt="">
																<span class="link-text">
																Bieber Fever
																</span>
																</a>
															</div>
															-->
														</div>
														<hr class="yt-horizontal-rule ">
														<?php } ?>
													<div class="section created-by-section">
														<div class="user-profile-item">
															by <span class="yt-user-name " dir="ltr"><?php echo htmlspecialchars($_user['username']); ?></span>
														</div>
														<div class="user-profile-item ">
															<h5>Latest Activity</h5>
															<span class="value"><?php echo date("M d, Y", strtotime($_user['lastlogin'])); ?></span>
														</div>
														<div class="user-profile-item ">
															<h5>Date Joined</h5>
															<span class="value"><?php echo date("M d, Y", strtotime($_user['created'])); ?></span>
														</div>
														<div class="user-profile-item ">
															<h5>Country</h5>
															<span class="value"><?php echo htmlspecialchars($_user['country']); ?></span>
														</div>
														<?php if($_user['genre'] != "none") { ?>
															<div class="user-profile-item ">
																<h5>Channel Genre</h5>
																<span class="value"><?php echo htmlspecialchars(ucfirst($_user['genre'])); ?></span>
															</div>
														<?php } ?>
													</div>
													<hr class="yt-horizontal-rule ">
												</div>
											</div>
											<div class="channel-module other-channels yt-uix-c3-module-container other-channels-compact">
												<?php $_user['featured_channels'] = explode(",", $_user['featured_channels']); ?>
												<?php if(count($_user['featured_channels']) != 0) { ?>
												<div class="module-view other-channels-view">
													<h2 <?php if(@$_SESSION['siteusername'] == $_user['username']) { ?>style="display: inline-block;position: relative;bottom: 10px;"<?php } ?>>Featured Channels</h2> 
													<?php if(@$_SESSION['siteusername'] == $_user['username']) { 
														echo "<a href='#' style='float:right;font-size:11px;color:black;' onclick=';open_featured_channels();return false;'>edit</a>"; 
													} ?>
													<ul class="channel-summary-list ">
														<?php 
															foreach($_user['featured_channels'] as $user) {
																if($__user_h->user_exists($user)) {
														?>
															<li class="yt-tile-visible yt-uix-tile">
																<div class="channel-summary clearfix channel-summary-compact">
																	<div class="channel-summary-thumb">
																		<span class="video-thumb ux-thumb yt-thumb-square-46 "><span class="yt-thumb-clip"><span class="yt-thumb-clip-inner"><img src="http://s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="Thumbnail" onerror="this.onerror=null;this.src='/dynamic/thumbs/default.jpg';" data-thumb="/dynamic/pfp/<?php echo $__user_h->fetch_pfp($user); ?>" width="46"><span class="vertical-align"></span></span></span></span>
																	</div>
																	<div class="channel-summary-info">
																		<h3 class="channel-summary-title">
																			<a href="/user/<?php echo htmlspecialchars($user); ?>" class="yt-uix-tile-link"><?php echo htmlspecialchars($user); ?></a>
																		</h3>
																		<span class="subscriber-count">
																		<strong><?php echo $__user_h->fetch_subs_count($user); ?></strong>
																		subscribers
																		</span>
																	</div>
																</div>
															</li>
														<?php } } ?>
													</ul>
												</div>
												<?php } ?>
											</div>

											<?php 
												$stmt = $__db->prepare("SELECT * FROM playlists WHERE author = :search ORDER BY id DESC LIMIT 10");
												$stmt->bindParam(":search", $_user['username']);
												$stmt->execute();

												if($stmt->rowCount() != 0) {
											?>
												<div class="playlists-narrow channel-module yt-uix-c3-module-container">
													<div class="module-view gh-featured">
														<h2>Featured Playlists</h2>     
														<?php
														while($playlist = $stmt->fetch(PDO::FETCH_ASSOC)) { 
															$playlist['videos'] = json_decode($playlist['videos']);
														?> 
															<div class="playlist yt-tile-visible yt-uix-tile">
																<a href="/view_playlist?v=<?php echo $playlist['rid']; ?>">
																<span class="playlist-thumb-strip playlist-thumb-strip-252"><span class="videos videos-4 horizontal-cutoff"><span class="clip"><span class="centering-offset"><span class="centering">
																	<span class="ie7-vertical-align-hack">&nbsp;</span>
																	<img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" data-thumb="" alt="" class="thumb"></span></span></span>
																	<span class="clip"><span class="centering-offset"><span class="centering"><span class="ie7-vertical-align-hack">&nbsp;

																	</span><img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="" class="thumb"></span></span></span>
																	<span class="clip"><span class="centering-offset"><span class="centering"><span class="ie7-vertical-align-hack">&nbsp;</span>
																	<img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" alt="" class="thumb"></span></span></span><span class="clip"><span class="centering-offset"><span class="centering"><span class="ie7-vertical-align-hack">&nbsp;</span><img src="//s.ytimg.com/yt/img/pixel-vfl3z5WfW.gif" data-thumb="" alt="" class="thumb"></span></span></span></span><span class="resting-overlay"><img src="//s.ytimg.com/yt/img/channels/play-icon-resting-vflXxuFB8.png" class="play-button" alt="Play all">  <span class="video-count-box">
																<?php echo count($playlist['videos']); ?> videos
																</span>
																</span><span class="hover-overlay"><span class="play-all-container"><strong><img src="//s.ytimg.com/yt/img/channels/mini-play-all-vflZu1SBs.png" alt="">Play all</strong></span></span></span>
																</a>
																<h3>
																	<a href="/view_playlist?v=<?php echo $playlist['rid']; ?>" title="See all videos in playlist." class="yt-uix-tile-link">
																		<?php echo htmlspecialchars($playlist['title']); ?>
																	</a>
																</h3>
																<span class="playlist-author-attribution">
																by <?php echo htmlspecialchars($_user['username']); ?>
																</span>
															</div>
														<?php }  ?>
													</div>
												</div>
											<?php } ?>
										</div>
									</div>
								</div>
							