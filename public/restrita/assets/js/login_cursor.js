let clientX = -100;
    let clientY = -100;
    const innerCursor = document.querySelector(".cursor--small");
    const initCursor = () => {
        document.addEventListener("mousemove", e => {
            clientX = e.clientX;
            clientY = e.clientY;
        });
        const render = () => {
            innerCursor.style.transform = `translate(${clientX}px, ${clientY}px)`;
            // se você já estiver usando o TweenMax no seu projeto,
            // é preciso colocar TweenMax.set()
            // TweenMax.set(innerCursor, {
            //   x: clientX,
            //   y: clientY
            // });

            requestAnimationFrame(render);
        };
        requestAnimationFrame(render);
    };
    initCursor();

    let lastX = 0;
    let lastY = 0;
    let isStuck = false;
    let showCursor = false;
    let group, stuckX, stuckY, fillOuterCursor;
    const initCanvas = () => {
        const canvas = document.querySelector(".cursor--canvas");
        const shapeBounds = {
            width: 75,
            height: 100
        };
        paper.setup(canvas);
        const strokeColor = "rgba(255, 225, 106)";
        const strokeWidth = 1;
        const segments = 4;
        const radius = 25;
        // nós iremos precisar disso para animar a borda
        const noiseScale = 100; // velocidade
        const noiseRange = 4; // campo de distorção
        let isNoisy = false; // comando
        // elemento que irá determinar a forma da borda
        const polygon = new paper.Path.RegularPolygon(
            new paper.Point(0, 0),
            segments,
            radius
        );
        polygon.strokeColor = strokeColor;
        polygon.strokeWidth = strokeWidth;
        polygon.smooth();
        group = new paper.Group([polygon]);
        group.applyMatrix = false;
        const noiseObjects = polygon.segments.map(() => new SimplexNoise());
        let bigCoordinates = [];
        const lerp = (a, b, n) => {
            return (1 - n) * a + n * b;
        };
        const map = (value, in_min, in_max, out_min, out_max) => {
            return (
                ((value - in_min) * (out_max - out_min)) / (in_max - in_min) + out_min
            );
        };
        paper.view.onFrame = event => {
            // usando a interpolação linear, o círculo se moverá 0,2 (20%)
            // da distância entre sua posição atual com a do mouse
            // as coordenadas são definidas por frame
            lastX = lerp(lastX, clientX, 0.2);
            lastY = lerp(lastY, clientY, 0.2);
            group.position = new paper.Point(lastX, lastY);
        }
    }
    initCanvas();