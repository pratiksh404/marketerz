<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">Copyright {{ \Carbon\Carbon::now()->year }} ©
                    {{ $setting->title ?? config('adminetic.name', 'Marketerz') }} by <a
                        href="http://techcoderznepal.com/" target="_blank">Techcoderz Nepal</a> </p>
            </div>
        </div>
    </div>
</footer>