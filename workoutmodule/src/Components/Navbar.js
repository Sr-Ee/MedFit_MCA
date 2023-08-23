import React, { useEffect,useState } from 'react'
import Mainpage from './Mainpage';

export default function Navbar() {

    const [selecttype, settype] = useState('none');
    const [selectmuscle, setmuscle] = useState('none');
    const [selectdifficulty, setdifficulty] = useState('none');
   
    function handleselecttype(e){
        settype(e.target.value)
    }
    function handleselectmuscle(e){
        setmuscle(e.target.value)
    }
    function handleselectdifficulty(e){
    setdifficulty(e.target.value)
    }
  return (
    <>
    <div id="nav" ><div>Workout</div>
    
    <div style={{display:'flex',gap:"20px"}}>
    <div><select style={{padding:"5px",opacity:"0.9",border:"5px solid whitesmoke"}} name="group" id="group" value={selecttype} onChange={handleselecttype}>
                 <option value="cardio">cardio</option>
                 <option value="plyometrics">plyometrics</option>
                 <option value="strength">strength</option>
                 <option value="none">none</option>
              </select></div>
    

              <div><select style={{padding:"5px",opacity:"0.9",border:"5px solid whitesmoke"}} name="group" id="group" value={selectmuscle} onChange={handleselectmuscle}>
                 <option value="abdominals">abdominals</option>
                 <option value="biceps">biceps</option>
                 <option value="triceps">triceps</option>
                 <option value="none">none</option>
              </select></div>
              <div><select style={{padding:"5px",opacity:"0.9",border:"5px solid whitesmoke"}} name="group" id="group" value={selectdifficulty} onChange={handleselectdifficulty}>
                 <option value="beginner">beginner</option>
                 <option value="intermediate">intermediate</option>
                 <option value="expert">expert</option>
                 <option value="none">none</option>
              </select></div>
</div>
</div>
 {true ? <Mainpage type={selecttype} muscle={selectmuscle} difficulty={selectdifficulty}></Mainpage> : <p>Hello error</p>}
</>
  )
  
}
