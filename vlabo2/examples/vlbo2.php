<!DOCTYPE html>
<html>
	<head>
		<title>UltraVision Ext</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<style>
			html, body {
				height: 100%;
				overflow: hidden;
			}
			#blocker {
				position: absolute;
				/* background-color: rgba(255, 0, 0, 0.5); */
				top: 0px;
				left: 0px;
				width: 100%;
				height: 100%;
			}
		</style>
	</head>
	<body>
		<script src="../build/three.js"></script>
		<script src="js/controls/TrackballControls.js"></script>
		<script src="js/renderers/CSS3DRenderer.js"></script>

		<div id="container"></div>
		<div id="blocker"></div>

		<script>
		var data;
    var sw=1;
		var group = new THREE.Group();
		(function (handleload) {
			var xhr = new XMLHttpRequest;
			xhr.addEventListener('load', handleload, false);
			xhr.open('GET', './videodata.json', true);
			xhr.send(null);
		}(function handleLoad (event) {
			var xhr = event.target;
					data = JSON.parse(xhr.responseText);
					//console.log(data);
			 init();
			 animate();
		}));
			var camera, scene, renderer;
			var controls;

			var Element = function ( id, x, y, z, ry ) {
				var div = document.createElement( 'div' );
				div.style.width = '480px';
				div.style.height = '360px';
				div.style.backgroundColor = '#000';
				var iframe = document.createElement( 'iframe' );
				iframe.style.width = '480px';
				iframe.style.height = '360px';
				iframe.style.border = '0px';
				//iframe.src = [ 'https://www.youtube.com/embed/', id, '?rel=0' ].join( '' );
        iframe.src='http://jflabo.org/~rosh/vlabo2/examples/aaa.php?id='+id;
				div.appendChild( iframe );
				var object = new THREE.CSS3DObject( div );
				object.position.set( x, y, z );
				object.rotation.y = ry;
				return object;
			};

			function init() {
				var container = document.getElementById( 'container' );
				camera = new THREE.PerspectiveCamera( 50, window.innerWidth / window.innerHeight, 1, 5000 );
				camera.position.set( 500, 350, 750 );
				scene = new THREE.Scene();
				renderer = new THREE.CSS3DRenderer();
				renderer.setSize( window.innerWidth, window.innerHeight );
				container.appendChild( renderer.domElement );

				group.add( new Element( data["VIDEOCODE0"], 0, 0, 240, 0 ) );
		    group.add( new Element( data["VIDEOCODE1"], 240, 0, 0, Math.PI / 2 ) );
		    group.add( new Element( data["VIDEOCODE2"], 0, 0, - 240, Math.PI ) );
		    group.add( new Element( data["VIDEOCODE3"], - 240, 0, 0, - Math.PI / 2 ) );
		    scene.add( group );
				controls = new THREE.TrackballControls( camera );
				controls.rotateSpeed = 4;
				window.addEventListener( 'resize', onWindowResize, false );
				// Block iframe events when dragging camera
				var blocker = document.getElementById( 'blocker' );
				blocker.style.display = 'none';
				document.addEventListener( 'mousedown', function () { blocker.style.display = ''; } );
				document.addEventListener( 'mouseup', function () { blocker.style.display = 'none'; } );
			}
			function onWindowResize() {
				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();
				renderer.setSize( window.innerWidth, window.innerHeight );
			}
			function animate() {
				requestAnimationFrame( animate );
				if(sw==1){
				group.rotation.y += 0.01;// y軸方向に回転
				}
				controls.update();
				renderer.render( scene, camera );
			}
      function ck_sw(){
        if(sw==0){
        sw=1;
        }else{
        sw=0;
       }
       //alert("a");
      }
		</script>
	</body>
</html>
