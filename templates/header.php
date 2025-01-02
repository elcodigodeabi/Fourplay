<header>
	<div class="header-logo-invitacion">
		<a class="logo" href="menu.php">
			<?php include 'public/logo.php' ;?>		
		</a>
		<form class="hacer-peticion" action="processes/hacerPeticion.php" method="post">
	        <input class="hacer-peticion__grupo" type="text" name="nombreGrupo" placeholder="Nombre de grupo">
	        <input class="hacer-peticion__boton button-violet" type="submit" value="Mandar invitacion +" name="hacerPeticion">
	    </form>
	</div>	
	<div class="header-nav">
		<a class="header-nav__boton" href="menu.php">
			<svg width="16px" height="16px" viewBox="0 0 36 36" fill="none">
			<path d="M2 18.3262C2 14.6648 2 12.834 2.83072 11.3164C3.66144 9.79874 5.17912 8.85682 8.21445 6.97301L11.4144 4.98699C14.623 2.99566 16.2274 2 18 2C19.7726 2 21.377 2.99566 24.5856 4.98699L27.7856 6.97299C30.821 8.85682 32.3386 9.79874 33.1693 11.3164C34 12.834 34 14.6648 34 18.3262V20.76C34 27.0013 34 30.1221 32.1254 32.061C30.251 34 27.2339 34 21.2 34H14.8C8.76602 34 5.74904 34 3.87451 32.061C2 30.1221 2 27.0013 2 20.76V18.3262Z" stroke="#FFFFFF" stroke-width="3"/>
			<path d="M13.2002 24.4C14.5608 25.4085 16.2156 26 18.0002 26C19.7848 26 21.4396 25.4085 22.8002 24.4" stroke="#FFFFFF" stroke-width="3" stroke-linecap="round"/>
			</svg>
			<span class="header-nav__boton-nombre">Menu</span>
		</a>
		<a class="header-nav__boton" href="perfil.php">
			<svg width="16px" height="16px" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
			<g clip-path="url(#clip0_406_19)">
			<path fill-rule="evenodd" clip-rule="evenodd" d="M16 16C12.4704 16 9.6 13.1296 9.6 9.6C9.6 6.0704 12.4704 3.2 16 3.2C19.5296 3.2 22.4 6.0704 22.4 9.6C22.4 13.1296 19.5296 16 16 16ZM22.0128 17.0768C24.1984 15.3184 25.6 12.624 25.6 9.6C25.6 4.2976 21.3024 0 16 0C10.6976 0 6.4 4.2976 6.4 9.6C6.4 12.624 7.80161 15.3184 9.98721 17.0768C4.13281 19.2768 0 24.712 0 32H3.2C3.2 24 8.9424 19.2 16 19.2C23.0576 19.2 28.8 24 28.8 32H32C32 24.712 27.8672 19.2768 22.0128 17.0768Z" fill="#FFFFFF"/>
			</g>
			<defs>
			<clipPath id="clip0_406_19">
			<rect width="32" height="32" fill="white"/>
			</clipPath>
			</defs>
			</svg>
			<span class="header-nav__boton-nombre">Perfil</span>
		</a>
		<a class="header-nav__boton boton--cerrar-sesion" href="processes/cerrarSesion.php" id="cerrar-sesion" title="Cerrar sesión">
			<svg width="16px" height="16px" viewBox="0 0 32 32" fill="none">
			<path d="M17.2306 14.4475C17.2306 13.8044 16.6795 13.2831 15.9998 13.2831C15.3201 13.2831 14.769 13.8044 14.769 14.4475V17.5526C14.769 18.1956 15.3201 18.717 15.9998 18.717C16.6795 18.717 17.2306 18.1956 17.2306 17.5526V14.4475Z" fill="#FFFFFF"/>
			<path fill-rule="evenodd" clip-rule="evenodd" d="M18.8303 0.516619L22.8242 1.14638C24.7209 1.44541 26.2574 1.68767 27.4594 2.02622C28.7112 2.3788 29.7454 2.87273 30.5416 3.76201C31.3378 4.65128 31.683 5.69765 31.8448 6.92379C32 8.10115 32 9.57489 32 11.394V20.606C32 22.4251 32 23.8989 31.8448 25.0762C31.683 26.3024 31.3378 27.3487 30.5416 28.238C29.7454 29.1273 28.7112 29.6211 27.4594 29.9737C26.2574 30.3123 24.7209 30.5545 22.8244 30.8535L18.8303 31.4834C17.1348 31.7508 15.733 31.9718 14.6133 31.9975C13.439 32.0243 12.3503 31.8458 11.442 31.1178C10.6753 30.5033 10.2956 29.7043 10.0965 28.8085H9.34781C7.48882 28.8085 5.96963 28.8085 4.77028 28.6561C3.51662 28.4966 2.4297 28.1515 1.56211 27.3307C0.694499 26.5098 0.329732 25.4816 0.161183 24.2954C-6.45197e-05 23.1608 -3.18842e-05 21.7235 9.36283e-07 19.9648V12.0353C-3.18842e-05 10.2765 -6.45197e-05 8.83926 0.161183 7.70458C0.329732 6.51851 0.694499 5.4902 1.56211 4.66938C2.4297 3.84855 3.51662 3.50345 4.77028 3.34399C5.96964 3.19144 7.48879 3.19147 9.34779 3.1915H10.0965C10.2955 2.29562 10.6753 1.49677 11.442 0.882259C12.3503 0.15427 13.439 -0.0242885 14.6133 0.0025395C15.733 0.028141 17.1349 0.249239 18.8303 0.516619ZM9.84615 24.283C9.84614 25.0841 9.84611 25.8169 9.86491 26.4797H9.4359C7.46714 26.4797 6.11438 26.4772 5.09827 26.348C4.11756 26.2232 3.63669 26 3.30268 25.6839C2.96867 25.3679 2.73262 24.913 2.60076 23.9851C2.46417 23.0237 2.46154 21.744 2.46154 19.8814V12.1186C2.46154 10.256 2.46417 8.97621 2.60076 8.01489C2.73262 7.08706 2.96867 6.63211 3.30268 6.31611C3.63669 6.0001 4.11756 5.77678 5.09827 5.65204C6.11438 5.5228 7.46714 5.52032 9.4359 5.52032H9.86491C9.84611 6.18312 9.84614 6.9159 9.84615 7.71703V24.283ZM14.5539 2.33069C13.664 2.31034 13.2854 2.45701 13.033 2.65919C12.7808 2.86138 12.5656 3.19058 12.4406 4.02439C12.3106 4.89042 12.3077 6.06832 12.3077 7.80542V24.1945C12.3077 25.9317 12.3106 27.1096 12.4406 27.9756C12.5656 28.8095 12.7808 29.1386 13.033 29.3407C13.2854 29.543 13.664 29.6896 14.5539 29.6693C15.4782 29.6481 16.7068 29.4573 18.5178 29.1717L22.3394 28.5691C24.3353 28.2544 25.7195 28.034 26.7571 27.7418C27.7616 27.4587 28.2931 27.1464 28.6635 26.7326C29.0338 26.319 29.2723 25.7717 29.4021 24.7877C29.5362 23.7714 29.5385 22.4434 29.5385 20.5291V11.4709C29.5385 9.55654 29.5362 8.22858 29.4021 7.21231C29.2723 6.2283 29.0338 5.68098 28.6635 5.2673C28.2931 4.85362 27.7616 4.54119 26.7571 4.25822C25.7195 3.966 24.3353 3.74559 22.3394 3.43089L18.5178 2.82828C16.7068 2.54272 15.4782 2.35181 14.5539 2.33069Z" fill="#FFFFFF"/>
			</svg>
			<span class="header-nav__boton-nombre">Cerrar sesión</span>
		</a>
	</div>
</header>