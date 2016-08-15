/// @param context the context of the canvas
/// @param color color of the grid in string format
/// @param size size of the quads or separation between them
/// @param tickness is the tickness of lines in the grid
function drawGrid(context, color, size, tickness)
{
    context.save();
    context.strokeStyle = color;
    context.lineWidth = tickness;
    for (var i = size; i < context.canvas.width; i += size)
    {
        context.beginPath();
        context.moveTo(i, 0);
        context.lineTo(i, context.canvas.height);
        context.stroke();
        context.beginPath();
        context.moveTo(0, i);
        context.lineTo(context.canvas.width, i);
        context.stroke();
    }
    context.restore();
}

/// @param context the context of the canvas
/// @param x, y position in window/browser/viewport coordinates
function windowToCanvasCoord(canvas, x, y)
{
    var bbox = canvas.getBoundingClientRect();
    return { x: x - bbox.left * (canvas.width / bbox.width),
             y: y - bbox.top * (canvas.height / bbox.height)
    };
}

/// @param context the context of the canvas
/// @param x, y position where the color (r,g,b,a) would be placed
/// @param r, g, b color in RGB color space in range [0,255]
/// @param a must be in range 0 - 1, where 1 is fully opaque
function setPixel(context, x,y, r, g, b, a)
{
    /// on main function:
    /// var pixel = context.createImageData(1,1);
    /// var colorPixel = pixel.data;
    //colorPixel[0] = r;
    //colorPixel[1] = g;
    //colorPixel[2] = b;
    //colorPixel[3] = a;
    //context.putImageData(pixel, x, y);
    context.fillStyle = "rgba("+r+","+g+","+b+","+a+")";
    context.fillRect( x, y, 1, 1 );
}

/// Utility function to parse from float to int
function float2int (value)
{
    return value | 0;
}

/// @param context the context of the canvas
/// @param x1, y1 initial point of the line
/// @param x2, y2 final point of the line
/// @param r, g, b color in RGB color space in range [0,255]
/// @param a must be in range 0 - 1, where 1 is fully opaque
function drawLine(context, x1, y1, x2, y2, r, g, b, a)
{
    var dx = x2 - x1
    var dy = y2 - y1
    for (x = x1; x <= x2; x++)
    {
        y = y1 + dy * (x - x1) / dx;
        var intvalue = float2int(y);
        setPixel(context, x, intvalue, r, g, b, a);
    }
}

/// @param context the context of the canvas
/// @param x1, y1 initial point of the line
/// @param x2, y2 final point of the line
/// @param r, g, b color in RGB color space in range [0,255]
/// @param a must be in range 0 - 1, where 1 is fully opaque
function drawLineJS(context, x1, y1, x2, y2, r, g, b, a)
{
    context.save();
        context.strokeStyle = "rgba("+r+","+g+","+b+","+a+")";
        context.lineWidth = 1;
        context.beginPath();
        context.moveTo(x1, y1);
        context.lineTo(x2, y2);
        context.stroke();
    context.restore();
}

function main()
{
    var canvas = document.getElementById("canvas2D");
    var selection =  document.getElementById("method");
    var dragging = false;
    var pStart, pEnd;
    
    if (!canvas)
    {
        console.log("Failed to retrieve the <canvas> element");
        return;
    }
    var context = canvas.getContext("2d");
    

    drawGrid(context, "lightgray", 10, 0.5);

    canvas.addEventListener("mousedown", function (e)
    {
        dragging = !dragging;
        pStart = windowToCanvasCoord(canvas, e.clientX, e.clientY);
        pEnd = pStart;
    });

    canvas.addEventListener("mouseup", function (e)
    {
        dragging = false;
    });
    
    canvas.addEventListener("mousemove", function (e)
    {
        if (dragging)
        {
            context.clearRect(0, 0, canvas.width, canvas.height);
            drawGrid(context, "lightgray", 10, 0.5);

            if (selection.value == 0)
               drawLine(context, pStart.x, pStart.y, pEnd.x, pEnd.y, 0, 128, 255, 1);
            else if (selection.value == 1)
                drawLineJS(context, pStart.x, pStart.y, pEnd.x, pEnd.y, 128, 64, 128, 1);
                
            pEnd = windowToCanvasCoord(canvas, e.clientX, e.clientY);
            
            //draw coordinates position into canvas
            context.font = "10pt Arial";
            context.fillStyle = "rgba(50,50,50,1.0)";
            var pos = windowToCanvasCoord(canvas, float2int(e.clientX), float2int(e.clientY));
            var str = "(" + pos.x + "," + pos.y + ")";
            context.fillText(str, 10, 10);
        }
    });
}