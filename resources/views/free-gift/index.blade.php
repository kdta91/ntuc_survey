@extends('layout.app')

@section('content')
<div class="col-md-12 text-center">
    <div class="thank-you-container">
        <h1 class="mb-5">Thank you for your participation and spin the wheel for a free gift!</h1>

        <button id="spinner-button" class="mb-5" {{ ($has_prize) ? 'disabled' : '' }}></button>
    </div>

    <div id="spinner-container">
        <canvas id='canvas' width='500' height='500'>
            Canvas not supported, use another browser.
        </canvas>
        <img id="spinner-arrow" src="{{ asset('images/spin-arrow.png') }}" alt="Spinner arrow" />

        <div class="mt-5">
            <a href="{{ route('thankYou') }}" class="next-button {{ ($has_prize) ?' d-block' : '' }}"></a>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Create the wheel
    let theWheel = new Winwheel({
        'drawMode': 'image', // drawMode must be set to image.
        'numSegments': 4, // The number of segments must be specified.
        'imageOverlay': true, // Set imageOverlay to true to display the overlay.
        'lineWidth': 4, // Overlay uses wheel line width and stroke style so can set these
        'strokeStyle': '#00000000',
        // 'outerRadius': 600
        'segments': [{
                'text': 'Pen'
            },
            {
                'text': 'Tote Bag'
            },
            {
                'text': 'Notebook'
            },
            {
                'text': 'Collapsible Eco-Mug'
            },
        ],
        'drawText': false,
        'textOrientation': 'curved',
        'animation': // Note animation properties passed in constructor parameters.
        {
            'type': 'spinToStop', // Type of animation.
            'duration': 10, // How long the animation is to take in seconds.
            'spins': 16, // The number of complete 360 degree rotations the wheel is to do.
            // Remember to do something after the animation has finished specify callback function.
            'callbackFinished': 'getPrize()',

        }
    });

    // Create new image object in memory.
    let loadedImg = new Image();

    // Create callback to execute once the image has finished loading.
    loadedImg.onload = function () {
        theWheel.wheelImage = loadedImg; // Make wheelImage equal the loaded image object.
        theWheel.draw(); // Also call draw function to render the wheel.
    }

    // Set the image source, once complete this will trigger the onLoad callback (above).
    loadedImg.src = '../images/spinner_.png';

    function getPrize() {
        // Call getIndicatedSegment() function to return pointer to the segment pointed to on wheel.
        let winningSegment = theWheel.getIndicatedSegment();

        // Basic alert of the segment text which is the prize name.
        alert('You have won ' + winningSegment.text + '!');

        setTimeout(function() {
            location.reload();
            document.querySelector('#spinner-container .next-button').style.display = 'block';
        }, 3000);
    }

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#spinner-button').on('click', function () {
            $(this).prop('disabled', true);

            $.ajax({
                url: "{{route('drawPrize')}}",
                type: 'GET',
                success: function(data){
                    // console.log(data);
                    // console.log(data.luckyNumber);
                    // console.log(data.prize);
                    if (data.success && data.luckyNumber) {
                        let stopAt = data.luckyNumber;
                        theWheel.animation.stopAngle = stopAt;
                        theWheel.startAnimation();
                    }
                },
                error: function(error){
                    console.log(error);
                }
            });
        });
    });

</script>
@endsection
