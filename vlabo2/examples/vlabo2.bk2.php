<!DOCTYPE html>
<html>
 <head>
  <title>vlabo2 2018</title>
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
  <!-- <script src="js/controls/TrackballControls.js"></script> -->
  <script src="js/renderers/CSS3DRenderer.js"></script>

  <div id="container"></div>
  <div id="blocker"></div>

  <script>
  var data;
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
   //var controls;
   var group = new THREE.Group();
   var sw=1;
   var Element = function ( id, x, y, z, ry ) {

    var div = document.createElement( 'div' );
    div.style.width = '480px';
    div.style.height = '360px';
    div.style.backgroundColor = '#000';
           //div.addEventListener("click", show);

    var iframe = document.createElement( 'iframe' );
    iframe.style.width = '480px';
    iframe.style.height = '360px';
    iframe.style.border = '0px';

           iframe.src = [ 'https://www.youtube.com/embed/', id, '?rel=0' ].join( '' );
           //iframe.src='http://jflabo.org/~rosh/vlabo2/examples/aaa.php?id='+id;
           //iframe.onclick=function(){
           //    alert('a');
           //    console.log('a');
           //};

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
    // 原点方向を見つめる
    camera.lookAt(new THREE.Vector3(0, 0, 0));
    scene = new THREE.Scene();
    renderer = new THREE.CSS3DRenderer();
    renderer.setSize( window.innerWidth, window.innerHeight );
    container.appendChild( renderer.domElement );
    //var group = new THREE.Group();
    //json文字列
    //var json_data = data;
    //'{"suffix1":"value1","suffix2":"value2","suffix3":"value3"}';
    //JSONをパース
    //var data = JSON.parse(json_data);
    //alert(data["suffix1"]);

    //obj = JSON.parse(data);
    //console.log(data.count);
    group.add( new Element( data["VIDEOCODE0"], 0, 0, 240, 0 ) );
    group.add( new Element( data["VIDEOCODE1"], 240, 0, 0, Math.PI / 2 ) );
    group.add( new Element( data["VIDEOCODE2"], 0, 0, - 240, Math.PI ) );
    group.add( new Element( data["VIDEOCODE3"], - 240, 0, 0, - Math.PI / 2 ) );
    scene.add( group );

    // マテリアルを作成する
    const material = new THREE.SpriteMaterial({
      map: new THREE.TextureLoader().load("./particle.png"),
    });

    const sprite = new THREE.Sprite(material);
     sprite.position.set(-2,1,-2);
     scene.add(sprite);
    }

   function onWindowResize() {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize( window.innerWidth, window.innerHeight );
   }

   function animate() {
   if(sw==1){
   //group.rotation.x += 0.01;// x軸方向に回転
   group.rotation.y += 0.01;// y軸方向に回転
   //group.rotation.z += 0.01;// z軸方向に回転
   //console.log("object_cube.rotation : " ,group.rotation);
   }
   requestAnimationFrame( animate );
   //controls.update();
   renderer.render( scene, camera );

   }
  function ck_sw(){
    if(sw==0){
    sw=1;
    }else{
    sw=0;
   }
   alert("a");
  }
  </script>
 </body>
</html>
