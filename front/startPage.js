export default function startPage(){
    const startPage = `
    <button id="insert" style=background-color:#49b56d;border-style:outset;border-width:5px;border-color:#49b56d;>新增課程</button>
    <button id="delete" style=background-color:#49b56d;border-style:outset;border-width:5px;border-color:#49b56d;>刪除課程</button>
    <button id="select" style=background-color:#49b56d;border-style:outset;border-width:5px;border-color:#49b56d;>查詢所有課程</button>
    <button id="update" style=background-color:#49b56d;border-style:outset;border-width:5px;border-color:#49b56d;>更新課程資訊</button>
    <br>
    <div id="content"></div>
    `;
    return startPage;
};
