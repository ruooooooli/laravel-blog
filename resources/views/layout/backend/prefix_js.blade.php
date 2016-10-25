<script type="text/javascript">
    Config = {
        'token' : "{{ csrf_token() }}",
        'routes': {
            'upload_file' : "{{ route('backend::upload') }}",
        },
    };
</script>
