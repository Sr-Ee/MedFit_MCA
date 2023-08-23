
import React, { useEffect,useState } from 'react'
import Card from './Card';
export default function Mainpage(props) {
    let result= []
    var apiUrl=""
    const [resarr,setresult] = useState([])
    async function fetchExercises() {
        var muscle = "biceps";
        var apiKey = 'WU1IfV8JfLX6PjxVvm8iMQ==AkeGJdpBLHgk5EZw';
      apiUrl = 'https://api.api-ninjas.com/v1/exercises?muscle=' + props.muscle +'&type='+ props.type+'&difficulty='+props.difficulty;
      
    
        try {
           const response = await fetch(apiUrl, {
                method: 'GET',
                headers: {
                    'X-Api-Key': apiKey
                }
            });
    
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
          result = await response.json();
          setTimeout(()=>{setresult(result)  },0)
            console.log(result[0]);
        } catch (error) {
            console.error('Error:', error);
        }
    }
    
    
    
useEffect(()=>{
  fetchExercises()
},[props])
  return (
    <>
           {resarr.map((e)=>{
                 return <Card name={e.name} type={e.type} difficulty={e.difficulty} equip={e.equipment} muscle={e.muscle} inst={e.instructions}></Card>
           })}
    </>
  )
}
