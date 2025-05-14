import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';
import path from 'path';

// Функция для получения всех файлов из указанной директории рекурсивно
function getAllFiles(dirPath, arrayOfFiles = []) {
    const files = fs.readdirSync(dirPath);

    files.forEach((file) => {
        const fullPath = path.join(dirPath, file);
        if (fs.statSync(fullPath).isDirectory()) {
            arrayOfFiles = getAllFiles(fullPath, arrayOfFiles);
        } else {
            arrayOfFiles.push(fullPath);
        }
    });

    return arrayOfFiles;
}

// Получение всех файлов из css, js и fonts
const scssFiles = getAllFiles('resources/scss');
const jsFiles = getAllFiles('resources/js');
const fontFiles = getAllFiles('resources/fonts');

// Объединение всех путей
const inputFiles = [...scssFiles, ...jsFiles, ...fontFiles];

export default defineConfig({
    plugins: [
        laravel({
            input: inputFiles,
            refresh: true,
        }),
    ],
});
