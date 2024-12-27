<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    {{-- <div x-data="webcamCapture" x-init="init">
        <!-- Interact with the `state` property in Alpine.js -->
        <!-- Button to open the modal -->
        <button @click="isOpen = true; startWebcam()" type="button" class="btn btn-primary">
            Open Webcam
        </button>
        <!-- Modal -->
        <div x-show="isOpen" @keydown.escape.window="closeModal" @click.away="closeModal"
            class="fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-white p-4 rounded shadow-lg" @click.stop>
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold">Capture Image</h2>
                    <button @click="closeModal" class="text-gray-500 hover:text-gray-700">&times;</button>
                </div>
                <div class="mt-4">
                    <video id="webcam" autoplay class="w-full h-auto"></video>
                </div>
                <div class="mt-4 flex justify-end">
                    <button @click="captureImage" type="button" class="btn btn-success">Capture</button>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('webcamCapture', () => ({
                    isOpen: false,
                    async init() {
                        // Initialization logic if needed
                    },
                    async startWebcam() {
                        const video = document.getElementById('webcam');
                        if (navigator.mediaDevices.getUserMedia) {
                            const stream = await navigator.mediaDevices.getUserMedia({
                                video: true
                            });
                            video.srcObject = stream;
                            this.stream = stream;
                        }
                    },
                    closeModal() {
                        this.isOpen = false;
                        if (this.stream) {
                            this.stream.getTracks().forEach(track => track.stop());
                        }
                    },
                    async captureImage() {
                        const video = document.getElementById('webcam');
                        const canvas = document.createElement('canvas');
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        const context = canvas.getContext('2d');
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);
                        const imageData = canvas.toDataURL('image/png');

                        // Kirim data gambar ke server
                        const response = await fetch('/webcam/store', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                image: imageData
                            })
                        });

                        const result = await response.json();
                        console.log('Saved image as:', result.filename);

                        this.closeModal();
                    }
                }));
            });
        </script>
    </div> --}}
    <div x-data="webcamCapture()" x-init="init()">
        <button @click="isOpen = true; startWebcam()" type="button" class="btn btn-primary">
            Open Webcam
        </button>
        <!-- Modal -->
        <div x-show="isOpen" @keydown.escape.window="closeModal" @click.away="closeModal"
            class="fixed inset-0 flex items-center justify-center z-50">
            <div class="bg-white p-4 rounded shadow-lg" @click.stop>
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold">Capture Image</h2>
                    <button @click="closeModal" class="text-gray-500 hover:text-gray-700">&times;</button>
                </div>
                <div class="mt-4">
                    <video id="webcam" autoplay class="w-full h-auto"></video>
                </div>
                <div class="mt-4 flex justify-end">
                    <button @click="captureImage" type="button" class="btn btn-success">Capture</button>
                </div>
            </div>
        </div>

        <input type="hidden" name="{{ $getStatePath() }}" x-model="imageData">

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('webcamCapture', () => ({
                    isOpen: false,
                    imageData: '',
                    async init() {
                        // Initialization logic if needed
                    },
                    async startWebcam() {
                        const video = document.getElementById('webcam');
                        if (navigator.mediaDevices.getUserMedia) {
                            const stream = await navigator.mediaDevices.getUserMedia({
                                video: true
                            });
                            video.srcObject = stream;
                            this.stream = stream;
                        }
                    },
                    closeModal() {
                        this.isOpen = false;
                        if (this.stream) {
                            this.stream.getTracks().forEach(track => track.stop());
                        }
                    },
                    async captureImage() {
                        const video = document.getElementById('webcam');
                        const canvas = document.createElement('canvas');
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        const context = canvas.getContext('2d');
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);
                        this.imageData = canvas.toDataURL('image/png');
                        this.closeModal();
                    }
                }));
            });
        </script>
    </div>
</x-dynamic-component>
