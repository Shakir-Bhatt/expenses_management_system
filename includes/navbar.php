<div class="col-md-12 col-sm-12">
	<nav class="navbar navbar-expand-sm  navbar-light" style="background-color: #1d7abd;margin-top: 5px;">
	 	<ul class="navbar-nav mr-auto">
		    <li class="nav-item">
		      	<a class="nav-link" href="index.php?page=home">Add New</a>
		    </li>
		    <li class="nav-item">
		      	<a class="nav-link" href="index.php?page=dashboard">View Detail</a>
		    </li>
		</ul>

		<ul class="navbar-nav justify-content-center">
			<li class="nav-item dropdown">
      			<a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        			<?= $_SESSION['auth']['first_name'] ?>
      			</a>
	      		<div class="dropdown-menu">
	        		<a class="dropdown-item" href="controllers/logout.php">Log Out</a>
	      		</div>
	    	</li>
	    	<li class="nav-item">
		      	<a class="nav-link" href=""></a>
		    </li>
		    <li class="nav-item">
		      	<a class="nav-link" href=""></a>
		    </li>
		    <li class="nav-item">
		      	<a class="nav-link" href=""></a>
		    </li>
		    <li class="nav-item">
		      	<a class="nav-link" href=""></a>
		    </li>
		    <li class="nav-item">
		      	<a class="nav-link" href=""></a>
		    </li>
		</ul>
		
	</nav>

</div>	