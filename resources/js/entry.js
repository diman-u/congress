import * as FilePond from 'filepond';

FilePond.setOptions({
    server: {
        url: '/filepond/api',
        process: '/process',
        revert: '/process',
        patch: "?patch=",
        headers: {
            'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
        }
    }
});

alert('nice');