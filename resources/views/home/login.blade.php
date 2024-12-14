<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  @vite(['resources/css/login.css'])
</head>
<body>
<h2></h2>
<div class="container" id="container">
	<div class="form-container sign-up-container">



	</div>
	<div class="form-container sign-in-container">
  @if (Session::has('error'))
  <div class="alert alert-danger" role="alert">
      {{ Session::get('error') }}
  </div>
@endif
		<form action="{{ route('login') }}" method="post" >
      @csrf
			<h1>Sign in</h1>
			<div class="social-container">
				
			</div>
			<!-- <span>or use your account</span> -->
			<input type="number" name="nip" placeholder="NIP" />
			<input type="password" name="password" placeholder="Password" />
			<p>Pastikan Password Anda Benar!!</p>
			<button  style="cursor: pointer;">Sign In</button>
		</form>

    
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Mts Miftahul Huda</h1>
				<p style="font-size: 20px;">form isian Admin <br> <span>restricted Area</span></p>
				<button class="ghost" id="signUp">Tentang Kami</button>
			</div>
		</div>
	</div>
</div>


</body>
</html>