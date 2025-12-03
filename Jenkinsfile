pipeline {
    agent any // Usa cualquier agente disponible en Jenkins

    environment {
        COMPOSER_ALLOW_SUPERUSER = 1 // Permite que Composer se ejecute como root si es necesario
    }

    stages {

        stage('Construcción') {
            steps {
                echo '🔨 Instalando dependencias...'
                bat 'composer install'       // Instala dependencias PHP
                bat 'npm install'            // Instala dependencias JS
                bat 'npm run build'          // Compila assets con Vite
            }
        }

        stage('Pruebas unitarias') {
            steps {
                echo '🧪 Ejecutando tests con PHPUnit...'
                bat 'php artisan test'       // Ejecuta todos los tests en tests/Feature y tests/Unit
            }
        }

        stage('Análisis de calidad') {
            steps {
                echo '🔍 Ejecutando PHPStan...'
                bat 'vendor\\bin\\phpstan.bat analyse' // Verifica errores estáticos y tipos

                echo '📏 Ejecutando PHP_CodeSniffer...'
                bat 'vendor\\bin\\phpcs.bat --standard=PSR12 app' // Verifica estilo de código
            }
        }

        stage('Despliegue simulado') {
            steps {
                echo '🚀 Ejecutando script de despliegue...'
            }
        }
    }

    post {
        always {
            echo '🔔 Pipeline finalizado (éxito o fallo).'
        }

        success {
            echo '✅ ¡Pipeline exitoso!'
            bat '"C:\\_Programs\\curl.exe" -X POST -H "Content-Type: application/json" -d "{\\"content\\":\\"✅ TareAdmi: Pipeline exitoso\\"}" https://discord.com/api/webhooks/1430718146788069438/yiChnBcvTEp1vf4q0YAzIRT37ByOpiTzp0NK85nnMtGCOuSG1zZPqns-REgKW1i94iiW'
        }

        failure {
            echo '❌ El pipeline falló.'
            bat '"C:\\_Programs\\curl.exe" -X POST -H "Content-Type: application/json" -d "{\\"content\\":\\"❌ TareAdmi: Pipeline fallido\\"}" https://discord.com/api/webhooks/1430718146788069438/yiChnBcvTEp1vf4q0YAzIRT37ByOpiTzp0NK85nnMtGCOuSG1zZPqns-REgKW1i94iiW'
        }
    }
}

