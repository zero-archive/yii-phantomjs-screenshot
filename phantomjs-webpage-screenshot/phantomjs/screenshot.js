var page = new WebPage(),
    address, outfile, width, height;

if (phantom.args.length != 4) {
    console.log('Usage: screenshot.js URL filename width height');
    phantom.exit(1);
} else {
    address = phantom.args[0];
    outfile = phantom.args[1];

    page.viewportSize = {
        width: phantom.args[2],
        height: phantom.args[3]
    };

    page.clipRect = {
        width: phantom.args[2],
        height: phantom.args[3]
    };

    page.open(address, function (status) {
        if (status !== 'success') {
            console.log('Unable to load the address!');
            phantom.exit(1);
        } else {
            window.setTimeout(function () {
                page.render(outfile);
                phantom.exit();
            }, 200);
        }
    });
}
