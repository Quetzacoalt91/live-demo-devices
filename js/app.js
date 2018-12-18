$(function(){
  var baseDomain = window.baseDomain || 'demo.prestashop.com';
  var domain = {
		"api": `https://api.${baseDomain}/api/v1/`,
		"socket" : `https://socket.${baseDomain}`,
		"reverseProxy" : baseDomain,
		"backoffice" : `${baseDomain}/admin-dev/index.php?controller=AdminLogin&email=demo@prestashop.com&password=prestashop_demo&redirect=AdminModules`
	};

    function removeLoading(){
        $('.loading').removeClass('loading');
    }

    function getUrlVars(){
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }

    var params = getUrlVars();
    var init = $('.btn-explore-front');

    if (typeof params.view !== undefined){
        //console.log(params.view);
        switch (params.view) {
            case 'back':
                init = $('.btn-explore-bo');
                $('.btn-explore-front').removeClass('hide');
                $('.btn-explore-bo').addClass('hide');
                break;
            default:
                init = $('.btn-explore-front');
                break;
        }
    }

    //$("#framelive").attr("src", init.attr('href'));
    history.pushState({}, '', '?view=' + init.data("view"));

    $('#framelive').load(function () {
        $('#loadingMessage').css('display', 'none');
    });

    $('#header a.btn-explore').on('click', function(e){
        e.preventDefault();
        var explore = $(this).attr('href');
        $("#framelive").attr("src", explore);
        $('#header a.btn-explore').siblings('a.btn-explore').toggleClass('hide');
        history.pushState({}, '', '?view=' + $(this).data("view"));
        return false;
    });

    $('#devices').on('click', '.change-device', function(){
        var device = $(this).data('target');
        $('.change-device').removeClass('active');
        $(this).addClass('active');
        $('#iframe-container').removeClass().addClass(device).find('iframe');
        var $loadingElement = $('#iframe-wrapper');
        $('body').removeClass().addClass('framed-' + device);
    });

    $('.btn-collapse').on('click', function(){
        $('#header').toggle();
        $('body').toggleClass('collapsed');
        $(this).toggleClass('collapsed');
    });

    $(window).resize(function(){
        if ($(window).width() <= 1000){
            $('a[data-target=desktop]').trigger('click');
        }	
    });

    // Machine creation
    function requestMachine(callback) {
        let data = {'version': '1.7', 'api_key': 'anonymous'};

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: domain.api + 'machine',
            data: data
        })
        .done(function (data) {
            callback(null, data)
        })
        .fail(function () {
            callback(new Error('The service is unavailable, please try later'));
        });
    }

    function attachToMachine(err, result){
		if (err === null) {
            var container = result;
            var socket = io(domain.socket);
            var frontUrl = `http:/${container.name}.${domain.reverseProxy}`;
            var backUrl = `http:/${container.name}.${domain.backoffice}`;
			socket.on('connect', function () {
				socket.emit('sendId', container.id);
			});
			setTimeout(() => {
                $("#framelive").attr("src", frontUrl);
            }, 10000);
            
            // Apply URLs
            $(".btn-explore-front").attr('href', frontUrl);
            $(".btn-explore-bo").attr('href', backUrl);
        }
    }

    requestMachine(attachToMachine);
})

dataLayer = [];