<div>

    <div wire:ignore x-data x-init="if (window.pageEditor) return;
    
    const loadCss = () => {
        return new Promise(resolve => {
            if (document.querySelector('#grapes-css')) {
                resolve();
                return;
            }
    
            const link = document.createElement('link');
            link.id = 'grapes-css';
            link.rel = 'stylesheet';
            link.href = 'https://unpkg.com/grapesjs/dist/css/grapes.min.css';
            link.onload = resolve;
            document.head.appendChild(link);
        });
    };
    
    const loadJs = () => {
        return new Promise(resolve => {
            if (window.grapesjs) {
                resolve();
                return;
            }
    
            const script = document.createElement('script');
            script.src = 'https://unpkg.com/grapesjs';
            script.onload = resolve;
            document.body.appendChild(script);
        });
    };
    
    Promise.all([loadCss(), loadJs()]).then(() => {
    
        window.pageEditor = grapesjs.init({
    
            container: '#gjs',
    
            height: '80vh',
    
            width: 'auto',
    
            storageManager: false,
    
            fromElement: false,
    
            panels: {
                defaults: []
            },
    
            blockManager: {
                appendTo: '#blocks'
            },
    
            styleManager: {
                appendTo: '#styles'
            },
    
            layerManager: {
                appendTo: '#layers'
            },
    
            traitManager: {
                appendTo: '#traits'
            },
    
        });
    
    });">

        <div class="grid grid-cols-12 gap-4">

            <!-- Sidebar -->
            <div class="col-span-3">

                <div class="rounded-xl border bg-white p-4 shadow">

                    <h2 class="font-bold mb-3">
                        Blocks
                    </h2>

                    <div id="blocks"></div>

                    <hr class="my-5">

                    <h2 class="font-bold mb-3">
                        Layers
                    </h2>

                    <div id="layers"></div>

                    <hr class="my-5">

                    <h2 class="font-bold mb-3">
                        Styles
                    </h2>

                    <div id="styles"></div>

                    <hr class="my-5">

                    <h2 class="font-bold mb-3">
                        Traits
                    </h2>

                    <div id="traits"></div>

                </div>

            </div>

            <!-- Editor -->
            <div class="col-span-9">

                <div class="rounded-xl border overflow-hidden">

                    <div id="gjs"></div>

                </div>

            </div>

        </div>

    </div>

</div>
