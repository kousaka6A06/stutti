var Canvas = document.getElementById('canvas');
var ctx = Canvas.getContext('2d');

// リサイズ処理
var resize = function () {
    Canvas.width = Canvas.clientWidth;
    Canvas.height = Canvas.clientHeight;
};
window.addEventListener('resize', resize);
resize();

var elements = [];
var presets = {};

// 文字列「STUTTI」の各文字を配列として保持
var text = "STUTI";

// "o" 型のエレメントの定義
presets.o = function (x, y, s, dx, dy) {
    var charIndex = Math.floor(Math.random() * text.length); // 文字列のランダムなインデックス
    return {
        x: x,
        y: y,
        r: 12 * s,
        w: 30 * s, // フォントサイズ
        dx: dx,
        dy: dy,
        draw: function (ctx, t) {
            this.x += this.dx;
            this.y += this.dy;

            ctx.font = `${this.w}px sans-serif`; // フォントサイズを設定
            ctx.fillStyle = '#d5d5d5'; // 文字色の設定

            // 文字列の一文字を描画（ランダムな文字）
            ctx.fillText(text[charIndex], this.x + Math.sin((50 + x + (t / 10)) / 100) * 3, this.y + Math.sin((45 + x + (t / 10)) / 100) * 4);
        }
    };
};

// "x" 型のエレメントの定義
presets.x = function (x, y, s, dx, dy, dr, r) {
    var charIndex = Math.floor(Math.random() * text.length); // 文字列のランダムなインデックス
    r = r || 0;
    return {
        x: x,
        y: y,
        s: 20 * s,
        w: 30 * s, // フォントサイズ
        r: r,
        dx: dx,
        dy: dy,
        dr: dr,
        draw: function (ctx, t) {
            this.x += this.dx;
            this.y += this.dy;
            this.r += this.dr;

            var _this = this;

            ctx.save();

            ctx.translate(this.x + Math.sin((x + (t / 10)) / 100) * 5, this.y + Math.sin((10 + x + (t / 10)) / 100) * 2);
            ctx.rotate(this.r * Math.PI / 180);

            ctx.font = `${this.w}px sans-serif`; // フォントサイズを設定
            ctx.fillStyle = '#d5d5d5'; // 文字色の設定

            // 文字列の一文字を描画（ランダムな文字）
            ctx.fillText(text[charIndex], -this.s / 2, this.s / 2);

            ctx.restore();
        }
    };
};

// エレメントをキャンバスのサイズに基づいてランダムに配置
for (var x = 0; x < Canvas.width; x++) {
    for (var y = 0; y < Canvas.height; y++) {
        if (Math.round(Math.random() * 8000) == 1) {
            var s = ((Math.random() * 5) + 1) / 10;
            if (Math.round(Math.random()) == 1)
                elements.push(presets.o(x, y, s, 0, 0));
            else
                elements.push(presets.x(x, y, s, 0, 0, ((Math.random() * 3) - 1) / 10, (Math.random() * 360)));
        }
    }
}

// 描画をインターバルで実行
setInterval(function () {
    ctx.clearRect(0, 0, Canvas.width, Canvas.height);

    var time = new Date().getTime();
    for (var e in elements) {
        elements[e].draw(ctx, time);
    }
}, 10);



///////////////////////////////
document.addEventListener('DOMContentLoaded', () => {
    const introText = document.getElementById('tuttiIntro');
    const contentWrapper = document.getElementById('tuttiContent');
    const backgroundText = document.getElementById('tuttiBackgroundText');

    // 初期テキストのフェードアウト
    setTimeout(() => {
        introText.style.opacity = 0;

        // 初期テキストが非表示になった後
        setTimeout(() => {
            introText.style.display = 'none'; // 初期テキストを完全非表示
            contentWrapper.classList.replace('tutti-hidden', 'tutti-visible'); // コンテンツを表示
        }, 500); // 初期テキストのフェードアウト時間
    }, 2000);

    // Intersection Observerでセクションを監視
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                // セクションに対応する背景テキストに変更
                backgroundText.textContent = entry.target.dataset.background;
            }
        });
    }, {
        threshold: 0.35, // 50%が表示されたときにトリガー
    });

    // 各セクションを監視
    const sections = document.querySelectorAll('.tutti-section');
    sections.forEach((section) => observer.observe(section));
});

////// カードの文章省略 ///////
const limit = document.querySelector(".txt-limit");
const str = limit.textContent;
const len = 40; // 半角50字（全角約25字）
if (str.length > len) {
    limit.textContent = str.substring(0, len) + "…";
}
/////////////////////////////

////// テキスト入力時に絵文字除去 ///////
function removeEmoji(e) {
    var validated = '';
    Array.prototype.forEach.call(e.value, function(c) {
      if (
        c.match(/[A-Za-z0-9]/)
        || c.match(/[Ａ-Ｚａ-ｚ０-９]/)
        || c.match(/[ -/:-@\[-~]/)
        || c.match(/[\n|\r\n|\r]/)
        || c.match(/[\u30a0-\u30ff\u3040-\u309f]/)
        || c.match(/[\u3400-\u9FFF\uF900-\uFAFF]|[\uD840-\uD87F][\uDC00-\uDFFF]/)
        || c.match(/[ｦ-ﾟ]/)
        || c.match(/[　、。，．・：；？！゛゜´｀＾]/)
        || c.match(/[￣＿ヽヾゝゞ〃仝々〆〻〇ー―‐／＼]/)
        || c.match(/[～｜…‥‘’“”°′″＃＆＊＠※]/)
        || c.match(/[（）〔〕［］｛｝〈〉《》「」『』【】]/)
        || c.match(/[＋－±×÷＝≠＜＞≦≧∞∴℃￥＄％〒]/)
        || c.match(/[☆★○●◎◇◆□■△▲▽▼→←↑↓⇒⇔]/)
        || c.match(/[⓪①②③④⑤⑥⑦⑧⑨⑩⑪⑫⑬⑭⑮⑯⑰⑱⑲⑳]/)
        || c.match(/[ⅠⅡⅢⅣⅤⅥⅦⅧⅨⅩ]/)
      ) {
        validated += c;
      }
    });
    e.value = validated;
}

///////////////////////////////////////////
// スムーズスクロール
document.querySelector('.scroll-indicator').addEventListener('click', () => {
    window.scrollTo({
        top: window.innerHeight,
        behavior: 'smooth'
    });
});
// テキストの再生アニメーション
document.querySelector('.typing-text').addEventListener('animationend', (e) => {
    if (e.animationName === 'typing') {
        e.target.style.width = '100%';
    }
});

/////////////////////////////////////////////

///////            削除確認用            ////

function deleteUsrBeutton() {
        let result = confirm('本当にユーザーを削除しますか。');
        if(result){
            return true;
        } else {
            alert('削除をとりやめました。');
            return false;
        }
}

function deleteGroupBeutton() {
    let result = confirm('本当に勉強会を削除しますか。');
    if(result){
        return true;
    } else {
        alert('削除をとりやめました。');
        return false;
    }
}

function deleteMessageButton() {
    let result = confirm('本当にメッセージを削除しますか。');
    if(result){
        return true;
    } else {
        alert('削除をとりやめました。');
        return false;
    }
}