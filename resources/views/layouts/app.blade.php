<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }} | SI-LUMAN</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap5.css') }}">
    <link rel="icon" href="{{ asset('img/logo2.png') }}">
    <link rel="stylesheet" href="{{ asset('css/public.css') }}">
    @if ($id_page == 1)
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />  
    @endif
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
</head>
<body style="background: #e5e1d6;">

    @include('components.header')

    @yield('content')

    @if (!in_array($id_page, [7, 8, 9, 10]))
        
    @include('components.footer')

    @endif
    
    <script src="{{ asset('js/bootstrap5.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#users').DataTable();
            $('#data').DataTable();
        });
    </script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace()
    </script>

    @if ($id_page == 1)
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
    $('.owl-carousel').owlCarousel({
        loop:true,
        nav:true,
        autoplay:true,
        autoplayTimeout:3500,
        autoplayHoverPause:true,
        center:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })
    </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('components.popup')

    @if ($id_page == 3)
    <script>
        const searchInput = document.getElementById('searchInput');
        const container = document.getElementById('container');
    
        searchInput.addEventListener('input', function() {
            const searchText = searchInput.value.toLowerCase();
            const cards = container.querySelectorAll('div[data-searchable]');
    
            for (let i = 0; i < cards.length; i++) {
                const card = cards[i];
                const content = card.innerText.toLowerCase();
    
                if (content.includes(searchText)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        })
    </script>
    @endif

    @if ($id_page == 19)
    <script>
        const fileInputs = document.getElementsByClassName("file-input");
        const fileNameDisplays = document.getElementsByClassName("file-name");
    
        // Loop through each file input element
        for (let i = 0; i < fileInputs.length; i++) {
            const fileInput = fileInputs[i];
            const fileNameDisplay = fileNameDisplays[i];
    
            fileInput.addEventListener("change", function() {
            const selectedFile = fileInput.files[0];
            if (selectedFile) {
                fileNameDisplay.textContent = "Selected file: " + selectedFile.name;
            } else {
                fileNameDisplay.textContent = "";
            }
            });
        }
    </script>
    @endif


</body>
</html>