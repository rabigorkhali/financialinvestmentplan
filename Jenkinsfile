pipeline {
  agent any
  stages {
        stage('get_commit_msg') {
          agent any
           when {
             anyOf {
                branch 'dev';
                branch 'qa';
             }
            }
          steps {
              script {
                notifyStarted()
                passedBuilds = []
                lastSuccessfulBuild(passedBuilds, currentBuild);
                env.changeLog = getChangeLog(passedBuilds)
                echo "changeLog \n${env.changeLog}"
              }
          }
        }


        stage('Dev Build') {
        agent any
        when {
                branch 'dev'
            }
        steps {
          script {
            sshagent(['72c3455a-de8d-4b39-9f02-771ddb2fdf00']) {
            sh '''
            ssh -tt -o StrictHostKeyChecking=no root@157.245.148.131 -p 3030 << EOF
            cd /var/www/ekcms/ekcms-larvel/dev/; \
            git pull origin dev; \
            composer install -n; \
            php artisan migrate; \
            php artisan db:seed; \
            nvm use 16.20.1; \
            npm install; \
            npm run dev; \
            exit
            EOF '''
            }
          }
          }
        }
        stage('VER-10 Build') {
        agent any
        when {
                branch 'ver-10'
            }
        steps {
          script {
            sshagent(['72c3455a-de8d-4b39-9f02-771ddb2fdf00']) {
            sh '''
            ssh -tt -o StrictHostKeyChecking=no root@157.245.148.131 -p 3030 << EOF
            cd /var/www/ekcms/ekcms-larvel/dev/; \
            git pull origin ver-10; \
            composer install -n; \
            php artisan migrate; \
            php artisan db:seed; \
            nvm use 18.16; \
            npm install; \
            npm run dev; \
            exit
            EOF '''
            }
          }
          }
        }
        stage('QA Build') {
        agent any
        when {
                branch 'qa'
            }
        steps {
          script {
            sshagent(['72c3455a-de8d-4b39-9f02-771ddb2fdf00']) {
            sh '''
            ssh -tt -o StrictHostKeyChecking=no root@157.245.148.131 -p 3030 << EOF
            cd /var/www/ekcms/ekcms-larvel/qa/; \
            git pull origin qa; \
            composer install -n; \
            php artisan migrate; \
            php artisan db:seed; \
            nvm use 16.20.1; \
            npm install; \
            npm run dev; \
            exit
            EOF '''
            }
            }
          }
        }
        stage('UAT Build') {
        agent any
        when {
                branch 'uat'
            }
        steps {
          script {
            sshagent(['72c3455a-de8d-4b39-9f02-771ddb2fdf00']) {
            sh '''
            ssh -tt -o StrictHostKeyChecking=no root@157.245.148.131 -p 3030 << EOF
            cd /var/www/ekcms/ekcms-larvel/uat/; \
            git pull origin uat; \
            composer install -n; \
            php artisan migrate; \
            php artisan db:seed; \
            nvm use 16.20.1; \
            npm install; \
            npm run dev; \
            exit
            EOF '''
            }
            }
          }
        }

  
        
  }


  post{
      success{
        script {
          if (env.BRANCH_NAME == 'dev' || env.BRANCH_NAME == 'qa' || env.BRANCH_NAME == 'uat' || env.BRANCH_NAME == 'live')
            notifySuccessful()
        }
      }
      failure{
        notifyFailed()
      }
  }
}
def notifyStarted() {
mattermostSend (
  color: "#2A42EE",
  channel: 'ekcms-laravel-jenkins',
  endpoint: 'https://ekbana.letsperk.com/hooks/1yhkb57ieing9ccpsoh7hqcs6o',
  message: "Build STARTED: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>)"
  )
}

def notifySuccessful() {
mattermostSend (
  color: "#00f514",
  channel: 'ekcms-laravel-jenkins',
  endpoint: 'https://ekbana.letsperk.com/hooks/1yhkb57ieing9ccpsoh7hqcs6o',
  message: "Build SUCCESS: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>):\n${changeLog}"
  )
}

def notifyFailed() {
mattermostSend (
  color: "#e00707",
  channel: 'ekcms-laravel-jenkins',
  endpoint: 'https://ekbana.letsperk.com/hooks/1yhkb57ieing9ccpsoh7hqcs6o',
  message: "Build FAILED: ${env.JOB_NAME} #${env.BUILD_NUMBER} (<${env.BUILD_URL}|Link to build>)"
  )
}
def lastSuccessfulBuild(passedBuilds, build) {
  if ((build != null) && (build.result != 'SUCCESS')) {
      passedBuilds.add(build)
      lastSuccessfulBuild(passedBuilds, build.getPreviousBuild())
   }
}

@NonCPS
def getChangeLog(passedBuilds) {
    def log = ""
    for (int x = 0; x < passedBuilds.size(); x++) {
        def currentBuild = passedBuilds[x];
        def changeLogSets = currentBuild.changeSets
        for (int i = 0; i < changeLogSets.size(); i++) {
            def entries = changeLogSets[i].items
            for (int j = 0; j < entries.length; j++) {
                def entry = entries[j]
                log += "* ${entry.msg} by ${entry.author} \n"
            }
        }
    }
    return log;
}
