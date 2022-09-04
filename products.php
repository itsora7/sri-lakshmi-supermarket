<?php include_once('HeaderNavigation.php'); ?>
	<div class="w3l_banner_nav_right">		
				<?php
					session_start();
					include_once('Includes/Connection.php');
					include_once('Includes/Config.php');
					$current_url = urlencode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
					$qry = "SELECT categoryid FROM category WHERE categoryname = '".$pathname."'";
					$result = mysqli_query($con, $qry);
					$row = mysqli_fetch_array($result);
					$qry1 = "SELECT ProductName, BrandName, quantity, price, ProductID, Image FROM product"; //WHERE category_id = '".$row[0]."'";
					$result1 = mysqli_query($con, $qry1);
					
					while($row1 = mysqli_fetch_array($result1)) { ?>
					
					<div class="col-md-3 w3ls_w3l_banner_left">
						<div class="hover14 column">
						<div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
							<!-- <div class="agile_top_brand_left_grid_pos">
								<img src="images/offer.png" alt=" " class="img-responsive" />
							</div> -->
							<div class="agile_top_brand_left_grid1">
								<figure>
									<div class="snipcart-item block">
										<div class="snipcart-thumb">
											<?php echo '<img src="data:image;base64,'.base64_encode($row1['Image']).'" class="img-responsive" style="height:150px"/>'; ?>
											<p style="text-align: center;"><?php echo $row1['ProductName']; ?></p>
											<h4 style="text-align: center;"><?php echo "$".$row1['price']." "; ?></h4>
										</div>
										<div class="snipcart-details">
											<form action="#" method="post">
												<fieldset>
													<input type="hidden" name="cmd" value="_cart" />
													<input type="hidden" name="add" value="1" />
													<input type="hidden" name="business" value=" " />
													<input type="hidden" name="item_name" value=<?php echo $row1['ProductName']; ?> />
													<input type="hidden" name="amount" value=<?php echo $row1['price']; ?> />
													<input type="hidden" name="discount_amount" value="0.00" />
													<input type="hidden" name="currency_code" value="AUD" />
													<input type="hidden" name="return" value=" " />
													<input type="hidden" name="cancel_return" value=" " />
													<input type="submit" name="submit" value="Add to cart" class="button" />
												</fieldset>
											</form>
										</div>
									</div>
								</figure>
							</div>
						</div>
						</div>
					</div>
					 <?php } ?>
				</div>
			</div>
				
			</div>
		</div>
	</div>
</div>
		<div class="clearfix"></div>
	
<?php include_once('Footer.php'); ?>
	