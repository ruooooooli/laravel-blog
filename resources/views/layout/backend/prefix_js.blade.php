<script type="text/javascript">
    Config = {
        'token' : "{{ csrf_token() }}",
        'routes': {
            'category_delete_batch' : "{{ route('backend::category.batch') }}",
            'upload_file'           : "{{ route('backend::upload') }}",
        },
    };
</script>
