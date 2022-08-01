@extends('layouts.nav')

@section('content')

<style>
    .menu .drapeaux {
        display: none;
    }
</style>

<div class="bodyStats">

    <div class="tab">
        <button class="tablinks" onclick="openStats(event, 'nbUrlVisit')">Visites par pages</button>
        <button class="tablinks" onclick="openStats(event, 'dailyVist_Platform')">visites globales et plateforme</button>
        <button class="tablinks" onclick="openStats(event, 'users_data')">Données utilisateurs</button>
        <button class="tablinks" onclick="openStats(event, 'quiz_certificat')">Téléchargement, résultats des quiz et certificats</button>
    </div>


    <div id="nbUrlVisit" class="tabcontent" style="width: 90%;height:650px;margin-bottom:50px;"></div>

    <div id="dailyVist_Platform" class="tabcontent">
        <div id="nbPlatform" style="width: 49%;height:650px;margin-bottom:50px;"></div>
        <div id="nbDailyVisit" style="width: 49%;height:650px;margin-bottom:50px;"></div>
    </div>

    <div id="users_data" class="tabcontent">
        <div class="age_sexe">
            <div id="nbUserAge" style="width: 49%;height:300px;margin-bottom:50px;"></div>
            <div id="nbUserSexe" style="width: 49%;height:300px;margin-bottom:50px;"></div>
        </div>

        <div class="pays_ville">
            <div id="nbUserPays" style="width: 49%;height:350px;margin-bottom:50px;"></div>
            <div id="nbUserVille" style="width: 49%;height:350px;margin-bottom:50px;"></div>
        </div>
    </div>

    <div id="quiz_certificat" class="tabcontent">
        <div id="excell" class="excell">
            <form action="{{ route('export') }}" method="get">
                @csrf
                <div class="excell_block">
                    <div class="excell_label_field">
                        <label for="formation_id">Téléchargement des données de formation (.xls)</label>
                        <select name="formation_id" id="formation_id" required>
                            <option value="" disabled selected>Sélectionnez une formation</option>
                            @foreach($formations as $formation)
                            <option value="{{ $formation->id }}">{{ $formation->titre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="excell_label_field">
                        <label for="date">Date à partir de laquelle faire la sélection</label>
                        <input type="date" name="date" id="date" value="2021-01-01" required>
                    </div>
                </div>
                <input type="submit" value="Télécharger">
            </form>
        </div>
        <div class="quiz_cert">
            <div id="nbQuiz" style="width: 49%;height:300px;margin-bottom:50px;"></div>
            <div id="nbCertificat" style="width: 49%;height:300px;margin-bottom:50px;"></div>
        </div>
    </div>

</div>

<script type="text/javascript">
    // TAB-----------------------------------------------------------
    var x = 0;

    if (x == 0) {
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 1; i < tabcontent.length; i++) {
            tabcontent[i].style.transform = "translateX(-10000px)";
        }
        x = 1;
    }


    function openStats(evt, statsId) {
        // Declare all variables
        var i, tabcontent, tablinks;

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 1; i < tabcontent.length; i++) {
            tabcontent[i].style.transform = "translateX(0px)";
        }

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(statsId).style.display = "flex";
        evt.currentTarget.className += " active";

    }

    // Quiz----------------------------------------------------------

    var quizzes = <?= json_encode($quiz->toArray(), JSON_HEX_TAG); ?>;
    var tquiz_id = [];
    var tquiz_titre = [];


    quizzes.map(quiz => {
        tquiz_id.push(quiz['countQuiz'])
    });
    quizzes.map(quiz => {
        tquiz_titre.push(quiz['quiz_titre'])
    });

    var chartQuiz = echarts.init(document.getElementById('nbQuiz'));

    option = {
        title: {
            text: 'Nombre de quiz réussis',
            // subtext: 'MEFH'
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        label: {
            show: true,
            // Text of labels.
            fontSize: '15px',
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: [{
            show: false,
            type: 'category',
            data: tquiz_titre,
            axisTick: {
                alignWithLabel: true
            }
        }],
        yAxis: [{
            type: 'value',
            axisLabel: {
                fontSize: '15px',
                margin: 10,
            }
        }],
        series: [{
            type: 'bar',
            barWidth: '60%',
            data: tquiz_id
        }]
    };

    chartQuiz.setOption(option);


    // Certificat----------------------------------------------------------

    var certificats = <?= json_encode($certificat->toArray(), JSON_HEX_TAG); ?>;
    var tcertificat_id = [];
    var tcertificat_titre = [];


    certificats.map(certificat => {
        tcertificat_id.push(certificat['countCertificat'])
    });
    certificats.map(certificat => {
        tcertificat_titre.push(certificat['formation_titre'])
    });

    var chartCertificat = echarts.init(document.getElementById('nbCertificat'));

    option = {
        title: {
            text: 'Certificats obtenus',
            // subtext: 'MEFH'
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        label: {
            show: true,
            // Text of labels.
            fontSize: '15px',
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: [{
            show: false,
            type: 'category',
            data: tcertificat_titre,
            axisTick: {
                alignWithLabel: true
            }
        }],
        yAxis: [{
            type: 'value',
            axisLabel: {
                fontSize: '15px',
                margin: 10,
            }
        }],
        series: [{
            type: 'bar',
            barWidth: '60%',
            data: tcertificat_id
        }]
    };

    chartCertificat.setOption(option);


    // UserAge----------------------------------------------------------

    var userAges = <?= json_encode($userAge->toArray(), JSON_HEX_TAG); ?>;
    var tuserAge_count = [];
    var tuserAget_age = [];


    userAges.map(userAge => {
        tuserAge_count.push(userAge['countUserAge'])
    });
    userAges.map(userAge => {
        tuserAget_age.push(userAge['user_age'])
    });

    var chartUserAge = echarts.init(document.getElementById('nbUserAge'));

    option = {
        title: {
            text: 'Tranche d\'age',
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: {
            type: 'value',
            boundaryGap: [0, 0.01]
        },
        label: {
            show: true,
            fontSize: '15px',
        },
        yAxis: {
            type: 'category',
            data: tuserAget_age
        },
        series: [{
            type: 'bar',
            data: tuserAge_count
        }]
    };

    chartUserAge.setOption(option);

    // UserSexe----------------------------------------------------------

    var userSexes = <?= json_encode($userSexe->toArray(), JSON_HEX_TAG); ?>;
    var tuserSexe_count = [];
    var tuserSexe_sexe = [];


    userSexes.map(userSexe => {
        tuserSexe_count.push(userSexe['countUserSexe'])
    });
    userSexes.map(userSexe => {
        tuserSexe_sexe.push(userSexe['user_sexe'])
    });

    var chartUserSexe = echarts.init(document.getElementById('nbUserSexe'));

    option = {
        title: {
            text: 'Sexe',
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: {
            type: 'value',
            boundaryGap: [0, 0.01]
        },
        label: {
            show: true,
            fontSize: '15px',
        },
        yAxis: {
            type: 'category',
            data: tuserSexe_sexe
        },
        series: [{
            type: 'bar',
            data: tuserSexe_count
        }]
    };

    chartUserSexe.setOption(option);


    // UserPays----------------------------------------------------------

    var userPays = <?= json_encode($userPays->toArray(), JSON_HEX_TAG); ?>;
    var tuserPay_count = [];
    var tuserPay_pay = [];


    userPays.map(userPay => {
        tuserPay_count.push(userPay['countUserPays'])
    });
    userPays.map(userPay => {
        tuserPay_pay.push(userPay['user_pays'])
    });

    var chartUserPays = echarts.init(document.getElementById('nbUserPays'));

    option = {
        title: {
            text: 'Pays',
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: {
            type: 'value',
            boundaryGap: [0, 0.01]
        },
        label: {
            show: true,
            fontSize: '15px',
        },
        yAxis: {
            type: 'category',
            data: tuserPay_pay
        },
        series: [{
            type: 'bar',
            data: tuserPay_count
        }]
    };

    chartUserPays.setOption(option);


    // UserVille----------------------------------------------------------

    var UserVilles = <?= json_encode($userVille->toArray(), JSON_HEX_TAG); ?>;
    var tuserVille_count = [];
    var tuserVille_ville = [];


    UserVilles.map(userVille => {
        tuserVille_count.push(userVille['countUserVille'])
    });
    UserVilles.map(userVille => {
        tuserVille_ville.push(userVille['user_ville'])
    });

    var chartUserVilles = echarts.init(document.getElementById('nbUserVille'));

    option = {
        title: {
            text: 'Code postal',
            // subtext: 'MEFH'
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        label: {
            show: true,
            // Text of labels.
            fontSize: '15px',
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: [{
            show: false,
            type: 'category',
            data: tuserVille_ville,
            axisTick: {
                alignWithLabel: true
            }
        }],
        yAxis: [{
            type: 'value',
            axisLabel: {
                fontSize: '15px',
                margin: 10,
            }
        }],
        series: [{
            type: 'bar',
            barWidth: '60%',
            data: tuserVille_count
        }]
    };

    chartUserVilles.setOption(option);


    // Platform-----------------------------------------------------------------

    var Platforms = <?= json_encode($platform->toArray(), JSON_HEX_TAG); ?>;
    var tplatform_count = [];
    var tplatform_platform = [];


    Platforms.map(platform => {
        tplatform_count.push(platform['countPlatform'])
    });
    Platforms.map(platform => {
        tplatform_platform.push(platform['platform'])
    });

    var chartPlatforms = echarts.init(document.getElementById('nbPlatform'));

    option = {
        title: {
            text: 'Plateforme utilisée',
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: {
            type: 'value',
            boundaryGap: [0, 0.01]
        },
        label: {
            show: true,
            fontSize: '15px',
        },
        yAxis: {
            type: 'category',
            data: tplatform_platform
        },
        series: [{
            type: 'bar',
            data: tplatform_count
        }]
    };

    chartPlatforms.setOption(option);


    // DailyVisit---------------------------------------------------------------

    var DailyVisits = <?= json_encode($dailyVisit->toArray(), JSON_HEX_TAG); ?>;
    var tdailyVisit_count = [];
    var tdailyVisit_dailyVisit = [];


    DailyVisits.map(dailyVisit => {
        tdailyVisit_count.push(dailyVisit['countIp'])
    });
    DailyVisits.map(dailyVisit => {
        tdailyVisit_dailyVisit.push(dailyVisit['date'])
    });

    var chartDailyVisits = echarts.init(document.getElementById('nbDailyVisit'));

    option = {
        title: {
            text: 'Visites journalières globales du site',
            // subtext: 'MEFH'
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        label: {
            show: true,
            // Text of labels.
            fontSize: '15px',
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: [{
            show: false,
            type: 'category',
            data: tdailyVisit_dailyVisit,
            axisTick: {
                alignWithLabel: true
            }
        }],
        yAxis: [{
            type: 'value',
            axisLabel: {
                fontSize: '15px',
                margin: 10,
            }
        }],
        series: [{
            type: 'bar',
            barWidth: '60%',
            data: tdailyVisit_count
        }]
    };
    chartDailyVisits.setOption(option);


    // UrlVisit---------------------------------------------------------------

    var UrlVisits = <?= json_encode($urlVisit->toArray(), JSON_HEX_TAG); ?>;
    var turlVisit_count = [];
    var turlVisit_urlVisit = [];


    UrlVisits.map(urlVisit => {
        turlVisit_count.push(urlVisit['countUrl'])
    });
    UrlVisits.map(urlVisit => {
        turlVisit_urlVisit.push(urlVisit['url'].replace("https://m-egalitefemmeshommes.org/", "").replace("http://m-egalitefemmeshommes.org", "Accueil").replace("https://www.m-egalitefemmeshommes.org", "Accueil").replace("https://m-egalitefemmeshommes.org", "Accueil"))
    });

    UrlVisits.map(urlVisit => {
        console.log('urlVisit   ' + urlVisit['url']);
    });

    var chartUrlVisits = echarts.init(document.getElementById('nbUrlVisit'));

    option = {
        title: {
            text: 'Visites journalières par page',
        },
        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'shadow'
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        xAxis: {
            type: 'value',
            boundaryGap: [0, 0.01]
        },
        label: {
            show: true,
            fontSize: '15px',
        },
        yAxis: {
            type: 'category',
            data: turlVisit_urlVisit
        },
        series: [{
            type: 'bar',
            data: turlVisit_count
        }]
    };

    chartUrlVisits.setOption(option);
</script>


@endsection