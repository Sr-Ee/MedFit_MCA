import React from 'react'

export default function Card(props) {
    // let color = ["#23ba21","#1ae4ff","#e92b2b","#7d21ba","#ba21ae","#b0ba21"]
    // var random_color = color[(Math.floor(
    //     Math.random() * color.length))];
    let videourl = 'https://www.youtube.com/results?search_query={props.muscle}' + props.name
  return (
    <>
        <div className="card m-3"  style={{width: "18rem;",borderColor:"black",border : "3px solid black"}}>
  <div className="card-body">
    <h5 className="card-title">{props.name}</h5>
    <div className="card" style={{width: "18rem",borderColor:"black"}}>
  <ul className="list-group list-group-flush">
    <li className="list-group-item">{props.type}</li>
    <li className="list-group-item">{props.muscle}</li>
    <li className="list-group-item">{props.equip}</li>
    <li className="list-group-item">{props.difficulty}</li>
  </ul>
</div>
    </div>
   
    <div className="card card-body" style={{width: "300px;"}}>
    <h5 style={{color:'black'}}>Instructions</h5>
      <p style={{color:'black'}}>{props.inst}</p>
      <a href={videourl} target='_blank'>Watch Video</a>
    </div>
  </div>

  

    </>
  )
}