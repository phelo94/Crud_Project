											<div class="menu-wrap">
				<div id="mobnav-btn">Menu <i class="fa fa-bars"></i></div>
				<ul class="sf-menu">
					<li>
						<a href="index.php">Home</a>
						<div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
						<ul>
							<li><a href="../index.php">Home</a></li>

						</ul>
					</li>
					<li>
						<a href="shop.php">Shop</a>
						<div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
						<ul>
						<!--  $r()
						only display the relating category made in admin,,, use 'id'  ,,,, $catr is category item 
				         -->
						<?php
							$catsql = "SELECT * FROM category";
							$catres = mysqli_query($connection, $catsql);
							while($catr = mysqli_fetch_assoc($catres)){
						 ?>
                             <li><a href="index.php?id=<?php echo $catr['id']; ?>"><?php echo $catr['name']; ?></a></li>
						<?php } ?>
						</ul>
					</li>
					<li>
						<a href="#">My Account</a>
						<div class="mobnav-subarrow"><i class="fa fa-plus"></i></div>
						<ul>
							<li><a href="#">My Orders</a></li>
							<li><a href="#">Logout</a></li>
						</ul>
					</li>
					<li>
						<a href="../index.php">Player Section</a>
					</li>
				</ul>
				<div class="header-xtra">
					<div class="s-cart">
						<div class="sc-ico"><i class="fa fa-shopping-cart"></i><em>2</em></div>

						<div class="cart-info">
							<small>You have <em class="highlight">4 item(s)</em> in your shopping bag</small>
							<br>
							<br>
							<div class="ci-item">
								<img src="../../../crudedit/cart/images/jersey.jpeg" width="70" alt=""/>
								<div class="ci-item-info">
									<h5><a href="./single-product.html">Jersey</a></h5>
									<p>2 x €100.00</p>
									<div class="ci-edit">
										<a href="#" class="edit fa fa-edit"></a>
										<a href="#" class="edit fa fa-trash"></a>
									</div>
								</div>
							</div>
							<div class="ci-item">
							<!--<img src="../../../crudedit/cart/images/jersey.jpeg"-->
								<img src="../../../crudedit/cart/images/jersey2.jpeg" width="70" alt=""/>
								<div class="ci-item-info">
									<h5><a href="./single-product.html">Jersey</a></h5>
									<p>2 x €100.00</p>
									<div class="ci-edit">
										<a href="#" class="edit fa fa-edit"></a>
										<a href="#" class="edit fa fa-trash"></a>
									</div>
								</div>
							</div>
							<div class="ci-total">Subtotal: €200.00</div>
							<div class="cart-btn">
								<a href="#">View Bag</a>
								<a href="#">Checkout</a>
							</div>
						</div>
					</div>
					<div class="s-search">
						<div class="ss-ico"><i class="fa fa-search"></i></div>
						<div class="search-block">
							<div class="ssc-inner">
								<form>
									<input type="text" placeholder="Type Search text here...">
									<button type="submit"><i class="fa fa-search"></i></button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>