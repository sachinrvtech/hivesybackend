<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css"> -->
<style type="text/css">
  .w3-button{border:none;display:inline-block;outline:0;padding:6px 16px;vertical-align:middle;overflow:hidden;text-decoration:none!important;color:#fff;background-color:#000;text-align:center;cursor:pointer;white-space:nowrap}
  .w3-button{color:#000;background-color:#f1f1f1;padding:8px 16px}.w3-button:hover{color:#000!important;background-color:#ccc!important}
  .w3-display-left{position:absolute;top:50%;left:0%;transform:translate(0%,-50%);-ms-transform:translate(-0%,-50%)}
  .w3-display-right{position:absolute;top:50%;right:0%;transform:translate(0%,-50%);-ms-transform:translate(0%,-50%)}
  .w3-black,.w3-hover-black:hover{color:#fff!important;background-color:#000!important}


</style>
<div class="w3-content w3-display-container">
  @foreach($dealpics as $dealpicss)
<div class="w3-display-container mySlides">
  <img src="{{ asset('/dealpics/'. $dealpicss['image_name']) }}" style="width:100%">
  <div class="w3-display-bottomleft w3-large w3-container w3-padding-16 w3-black">
    <a class="deleteProductImage" id="{{ $dealpicss['id']}}" title="Delete" style="cursor: pointer;"> <i class="fa fa-trash"></i></a>
    <br>
 </div>
</div>
@endforeach
<button class="w3-button w3-display-left w3-black" onclick="plusDivs(-1)">&#10094;</button>
<button class="w3-button w3-display-right w3-black" onclick="plusDivs(1)">&#10095;</button>

</div>

<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}
</script>
