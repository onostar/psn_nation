<style>
.clearanceSlip{
    /* position:relative; */
    width:45vw;
    margin:0;
    height:45vh!important;
    padding:10px;
    background:#fff;
    margin-bottom:20px;
    /* border:2px solid green!important; */
    /* box-shadow: 2px 2px 2px 2px #c4c4c4; */
}
/* .clearanceSlip .logos_passport{
    display:flex;
    flex-wrap:wrap;
    justify-content: space-between;
} */
.logos{
    display:flex;
    justify-content: center;
    align-items: center;
    color:#fff;
    width:100%;
    height:50px;
    background: var(--primaryColor);
    gap:.5rem;
    padding:5px;
}
.logos img{
    width:50px;
    height:100%;
    border-radius: 50%;
}
.slip{
    position:relative;
    width:100%;
    height:94%;
    overflow:hidden;
}
.slip_back{
    position:absolute;
    top:0;
    left:0;
    height:100%;
    width:100%;
    opacity: .05;
    text-align: center;
    overflow:hidden;

}
.slip_back img{
    width:100%;
    height:100%;
    object-fit: cover;
    overflow:hidden;

}
.passports{
    margin:5px;
    height:180px;
    width:180px;
    overflow: hidden;
    border-radius:50%;
    box-shadow: 2px 2px 2px 2px #c4c4c4;
}
.passports img{
    width:100%;
    height:100%;
}

.heading{
    text-align:center;
}
.details{
    padding:5px;
    display:flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align:Center;
    gap:0;
    height:100%;
    /* overflow: hidden; */
}
.details p{
    border:1px solid rgba(167, 164, 164, .5);
    padding:10px;
    color:rgba(66, 65, 65, .9);
    text-transform: uppercase;
    margin:0;
    font-size:1.1rem;
}
.details p span{
    font-weight: bolder;
    
}
.details .full_name{
    font-weight:bold;
}
/* .qr_code{
    
    border-radius:5px;
    border:2px solid #222;
} */
.qr_code img{
    height:40px;
    width: 100px;
    margin:0px auto;
}
.barcode{
    margin:1px;
    padding:0;
    font-size:.9rem;

}
.tag_sponsor{
    position:absolute;
    bottom:0;
    left:25%;
    width:50%;
    opacity:.7;
    height:25px;
    margin:0 auto;
}
.tag_sponsor img{
    width:100%;
    height:100%;
    /* object-fit: cover; */
}
</style>