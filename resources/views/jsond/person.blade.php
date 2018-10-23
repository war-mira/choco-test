<script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Person",
      "address":{
      	 "@type": "PostalAddress",
        "addressLocality": "{{$city}}",
     @if(isset($address))    "streetAddress": "{{$address}}" @endif
      },
      @if(isset($image))"image": "{{$image}}", @endif
    @if(isset($jobTitle))"jobTitle": "{{json_encode($jobTitle??'')}}", @endif
    @if(isset($name))"name": "{{$name}}", @endif
    @if(isset($phone))"telephone": "{{$phone??''}}", @endif
    "url": "{{$url}}"
    }

</script>