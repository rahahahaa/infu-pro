<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Channel Stats</title>
    <style>
        
.call-bar {
    margin-bottom: 0px!important;
    margin: 0;
    padding: 14px 0px;
    border: 0;
    position: fixed;
    z-index: 16000160;
    bottom: 0;
    /* text-align: center; */
    overflow: hidden;
    /* float: right; */
    /* text-align: right; */
    font-family: 'Poppins', sans-serif;
    right: 0;
    width: 100%;
    background: -webkit-linear-gradient( 135deg , #ff1053 0%, #3452ff 100%);
    text-align: center;
    border-top: 1px solid #eee;
    border-radius: 25px 25px 0px 0px;
}
.arrow {
    position: absolute;
    top: 32%;
    left: 16%;
    transform: translate(-50%, -50%);
    transform: rotate(270deg);
    cursor: pointer;
}
.arrow span {
    display: block;
    width: 1.3vw;
    height: 1.3vw;
    border-bottom: 5px solid white;
    border-right: 5px solid white;
    transform: rotate(45deg);
    margin: -10px;
    animation: animate 2s infinite;
}
.container {
    max-width: 1260px;
}

.call-bar p {
    margin-bottom: 0px;
    font-size: 1.1rem;
    align-items: center;
    display: flex;
    justify-content: center;
    color: #fff;
    line-height: 0px;
}
.call-bar p a {
    color: #fff;
    font-size: 1.1rem;
    font-weight: 500;
    margin: 0px 5px;
}


.foot-whtsap a {
    margin: 0px 15px;
}

.foot-whtsap {
    margin-bottom: 11px!important;
    margin: 0;
    padding: 0;
    border: 0;
    position: fixed;
    z-index: 16000160;
    bottom: 30px;
    /* text-align: center; */
    overflow: hidden;
    float: right;
    text-align: right;
    font-family: 'Poppins', sans-serif;
    right: 0;
}
@media (max-width: 768px) {
    .call-bar {
        padding: 10px 5px;
        border-radius: 15px 15px 0px 0px;
    }

    .call-bar p {
        font-size: 0.9rem;
        flex-direction: column;
        line-height: 1.5;
        text-align: center;
    }

    .call-bar p a {
        font-size: 0.9rem;
        display: block;
        margin: 5px 0;
    }

    .arrow {
        top: 25%;
        left: 10%;
        transform: scale(0.8);
    }

    .arrow span {
        width: 3vw;
        height: 3vw;
        border-bottom: 3px solid white;
        border-right: 3px solid white;
    }
}

</style>
</head>
<body>
    <h2>YouTube Channel Stats</h2>
    <form action="{{ route('youtube.fetch') }}" method="POST">
        @csrf
        <input type="text" name="channel_url" placeholder="Enter YouTube Channel URL or ID" required>
        <button type="submit">Get Details</button>
    </form>

    @if(session('data'))
        <h3>Channel Details:</h3>
        <p><strong>Subscribers:</strong> {{ session('data')['subscribers'] }}</p>
        <p><strong>Total Views:</strong> {{ session('data')['views'] }}</p>
        <p><strong>Total Videos:</strong> {{ session('data')['videos'] }}</p>
    @endif

</body>
</html>
