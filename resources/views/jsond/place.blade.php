<script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Place",
         @if(isset($name)) "name": "{{json_encode(htmlentities($name))}}",   @endif
      "address":{
      	 "@type": "PostalAddress",
        "addressLocality": "{{$city}}",
     @if(isset($address))    "streetAddress": "{{$address}}" @endif
    },
    @if(isset($phone))"telephone": "{{$phone}}",     @endif
    @if(isset($logo))"logo": "{{$logo}}",       @endif
    @if(isset($geo)) "geo": {
        "@type": "GeoCoordinates",
        "latitude": "{{$geo->latitude}}",
        "longitude": "{{$geo->longitude}}"
      },@endif
   @if(isset($url)) "url": "{{$url}}"@endif
  }
</script>