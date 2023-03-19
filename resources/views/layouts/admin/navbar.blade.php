<nav class="main-nav" role="navigation">

	  <!-- Mobile menu toggle button (hamburger/x icon) -->
	  <input id="main-menu-state" type="checkbox" />
	  <label class="main-menu-btn" for="main-menu-state">
		<span class="main-menu-btn-icon"></span> Toggle main menu visibility
	  </label>

	  <!-- Sample menu definition -->
	  <ul id="main-menu" class="sm sm-blue">			
		<li><a href="{{ route('admin.home') }}"><i data-feather="home"></i>Dashboard</a>
			
		</li>
		<li>
			<a href="{{route('admin.account_types.index')}}">
				<i data-feather="home"></i>
				<span> Account Type </span>
			</a>
		</li>
		<li><a href="#"><i data-feather="file-plus"></i>Items</a>					
		  	<ul>					
			  	<li><a href="{{route('admin.items.add')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Item</a></li>
            	<li><a href="{{route('admin.items.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>All Items</a></li>			
		  	</ul>
		</li> 
		<li>
			<a href="{{route('admin.cash.index')}}">
			<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
				<span> Cash BooK </span>
			</a>
		</li>  
		<!-- Medicine -->
		<li>
			<a href="{{route('admin.medicines.index')}}">
			<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
				<span> Medicines </span>
			</a>
			<ul>
				<li>
					<a href="{{route('admin.medicines.purchase_medicine')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Purchase Medicine</a>
					<a href="{{route('admin.medicines.sale_medicine')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sale </a>
				</li>
			</ul>	
		</li>

		<!-- Feed -->
		<li>
			<a href="#">
			<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
				<span> Feed </span>
			</a>
			<ul>
				<li>
					<a href="{{route('admin.feeds.purchase_feed')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Purchase Feed</a>
					<a href="{{route('admin.feeds.sale_feed')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sale Feed</a>
				</li>
			</ul>	
		</li>

		<!-- Chick -->
		<li>
			<a href="#">
			<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
				<span> Chicks </span>
			</a>
			<ul>
					<li>
						<a href="{{route('admin.chicks.purchase_chick')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Purchase Chicks</a>
						<a href="{{route('admin.chicks.sale_chick')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sale Chicks</a>
					</li>
			  </ul>	
		</li>

		<!-- Murghi -->
		<li>
			<a href="#">
			<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
				<span> Murghi </span>
			</a>
			<ul>
					<li>
						<a href="{{route('admin.purchase_murghis.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Purchase Murghi</a>
						<a href="{{route('admin.sale_murghis.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sale Murghi</a>
					</li>
			  </ul>	
		</li>

		<!-- Company -->
		<li>
			<a href="{{route('admin.companys.index')}}">
			<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
				<span> Companies </span>
			</a>
		</li>


		<!-- Flock -->
		<li>
			<a href="{{route('admin.flocks.index')}}">
			<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
				<span> Flocks </span>
			</a>
		</li>

		<!-- Shade -->
		<li>
			<a href="{{route('admin.shades.index')}}">
			<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
				<span> Shades </span>
			</a>
		</li>

		
		<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Ledger</a>
			  <ul>
					<li>
						<a href="{{route('admin.reports.item')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Purchase Book Ledger</a>
						<a href="{{route('admin.reports.sale_book')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sale Book Ledger</a>
						<a href="{{route('admin.reports.inward')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Inward Ledger</a>
						<a href="{{route('admin.reports.outward')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Outward Ledger</a>
						<a href="{{route('admin.reports.account')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Account Ledger</a>
					</li>
			  </ul>			  
			</li> 
		
		<li><a href="#"><i data-feather="lock"></i>Staff &amp; Permission</a>
		  <ul>
			<li><a href="{{route('admin.staffs.all')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Staff</a>
			</li>
			<li><a href="{{route('admin.permissions.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Permissions</a>
			  		  
			</li>
		  </ul>		  
		</li>
		<li>
                    <a href="{{route('admin.orders.index')}}">
                        <i data-feather="home"></i>
                        <span> Orders </span>
                    </a>
                </li>
		<li>
			<a href="{{route('admin.consumptions.index')}}">
			<i class="fa fa-minus-circle" aria-hidden="true"></i>
				<span> Consumption </span>
			</a>
		</li>

		<li>
			<a href="{{route('admin.manufactures.index')}}">
			<i class="fa fa-minus-circle" aria-hidden="true"></i>
				<span> Manufacture </span>
			</a>
		</li>
				  
		<li><a href="#"><i data-feather="mail"></i>Formulation</a>
		  <ul>
			<li><a href="{{route('admin.formulations.add')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Formulation</a>			  
			</li>
			<li><a href="{{route('admin.formulations.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>All Formulation</a>	
			</li>			
		  </ul>		  	
		</li>  
		
		
		
		<li><a href="#"><i data-feather="mail"></i>Accounts</a>
			<ul>
			@foreach($grand_parents AS $grand)
						@if($grand->childs->isNotEmpty())
							<li><a href="#"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>{{ $grand->name }}</a>

								
									<ul class="nav-second-level">
										@foreach($grand->childs()->get() AS $child)
											<li><a href="{{ route('admin.accounts.add', ['grand_parent_id'=>$grand->hashid, 'parent_id'=>$child->hashid]) }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>{{ $child->name }}</a></li>
										@endforeach
									</ul>
								
							</li>
						@endif
					@endforeach 	
			</ul>
			
		</li> 
	  </ul>
	</nav>

 

