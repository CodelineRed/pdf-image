import fs from 'fs';
import path from 'path';

const files = [
    {
        "source": "./node_modules/@fortawesome/fontawesome-free/js/fontawesome.min.js",
        "target": "./public/js/fontawesome.min.js"
    },
    {
        "source": "./node_modules/@fortawesome/fontawesome-free/js/brands.min.js",
        "target": "./public/js/brands.min.js"
    },
    {
        "source": "./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js",
        "target": "./public/js/bootstrap.bundle.min.js"
    },
    {
        "source": "./node_modules/bootstrap/dist/css/bootstrap.min.css",
        "target": "./public/css/bootstrap.min.css"
    }
];

for (let i = 0; i < files.length; i++) {
    if (fs.existsSync(files[i].source)) {
        fs.copyFile(files[i].source, files[i].target, (err) => {
            if (err) {
                throw err;
            }

            let source = path.basename(files[i].source);
            let target = path.basename(files[i].target);

            console.log(`Node file ${source} was copied to Public file ${target}`);
        });
    }
}
