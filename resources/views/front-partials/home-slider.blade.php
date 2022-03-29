<div  class="rev_slider_wrapper fullwidthbanner-container" data-alias="classic4export" data-source="gallery">
    <div id="b-home_01_slider" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.4.1">
        <ul>
            @foreach($sliderItems as $slider)
            <li data-index="rs-30" data-transition="zoomout" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000"  data-thumb="{{ asset( $slider->desktopImage()->getUrl()) }}"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off"  data-title="Intro" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                <img src="{{ asset( $slider->desktopImage()->getUrl()) }}"  alt=""  data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                <div class="tp-caption tp-resizeme font-title rs-parallaxlevel-1"
                     data-x="['left','left','left','center']"
                     data-hoffset="['50','20','20','0']"
                     data-y="['middle','middle','middle','middle']"
                     data-voffset="['-47','-47','-47','-22']"
                     data-fontsize="['250','250','250','210']"
                     data-width="none"
                     data-height="none"
                     data-whitespace="nowrap"
                     data-type="text"
                     data-responsive_offset="on"
                     data-frames='[{"delay":650,"speed":700,"frame":"0","from":"y:-50px;opacity:0;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"y:-50px;opacity:0;","ease":"nothing"}]' data-textalign="['left','left','left','left']"
                     data-paddingtop="[0,0,0,0]"
                     data-paddingright="[0,0,0,0]"
                     data-paddingbottom="[0,0,0,0]"
                     data-paddingleft="[0,0,0,0]"
                     style="font-size: 250px; font-family: lora; line-height: 22px; font-weight: 400; color: rgba(255, 255, 255, 0.2); z-index: 999">
                    {{ $slider->second_text }}
                </div>
                <div class="tp-caption  tp-resizeme"
                     data-x="['left','left','left','center']"
                     data-hoffset="['50','20','20','0']"
                     data-y="['middle','middle','middle','middle']"
                     data-voffset="['-30','-30','-30','-24']"
                     data-fontsize="['120','120','120','70']"
                     data-width="none"
                     data-height="none"
                     data-whitespace="nowrap"
                     data-type="text"
                     data-responsive_offset="on"
                     data-frames='[{"delay":500,"speed":700,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":600,"frame":"999","to":"x:-50px;opacity:0;","ease":"nothing"}]' data-textalign="['left','left','left','left']"
                     data-paddingtop="[0,0,0,0]"
                     data-paddingright="[0,0,0,0]"
                     data-paddingbottom="[0,0,0,0]"
                     data-paddingleft="[0,0,0,0]"
                     style="font-size: 120px; line-height: 22px; font-weight: 700; color: rgb(255, 255, 255); z-index: 999">
                    {{ $slider->main_text }}
                </div>
{{--                <div class="tp-caption tp-resizeme"--}}
{{--                     data-x="['left','left','left','center']"--}}
{{--                     data-hoffset="['50','30','30','0']"--}}
{{--                     data-y="['top','top','top','top']"--}}
{{--                     data-voffset="['420','420','390','270']"--}}
{{--                     data-fontsize="['73','73','73','40']"--}}
{{--                     data-width="none"--}}
{{--                     data-height="none"--}}
{{--                     data-whitespace="nowrap"--}}
{{--                     data-type="text"--}}
{{--                     data-responsive_offset="on"--}}
{{--                     data-frames='[{"delay":700,"speed":700,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":500,"frame":"999","to":"y:50px;opacity:0;","ease":"nothing"}]' data-textalign="['inherit','inherit','inherit','inherit']"--}}
{{--                     data-paddingtop="[0,0,0,0]"--}}
{{--                     data-paddingright="[0,0,0,0]"--}}
{{--                     data-paddingbottom="[0,0,0,0]"--}}
{{--                     data-paddingleft="[0,0,0,0]" >--}}
{{--                    <a href="#" class="btn btn-full">LEARN MORE</a>--}}
{{--                </div>--}}
            </li>
            @endforeach
        </ul>
        <div class="tp-bannertimer" style="height: 7px; background-color: rgba(255, 255, 255, 0.25);"></div>
    </div>
</div>
