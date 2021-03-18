export default {
    data: () => ({
        loading: false,
        e1: 1,
        plans: [
            {name: 'Cut', type: [{title: 'Mens', src: 'images/cut.jpg', price: 2900, duration: 30, description: 'Men&#39;s Haircut with Best Shampoo, Styling and Massage', isSelected: false}, {title: 'Ladies', src: 'images/cut.jpg', price: 3300, duration: 60, description: 'Men&#39;s Haircut with Best Shampoo, Styling and Massage', isSelected: false}]},
            {name: 'Perm', type: [{title: 'ColdPerm', src: 'images/perm.jpg', price: 5500, duration: 90, description: 'Men&#39;s Haircut with Best Shampoo, Styling and Massage', isSelected: false}, {title: 'CreepPerm', src: 'images/perm.jpg', price: 7700, duration: 150, description: 'Men&#39;s Haircut with Best Shampoo, Styling and Massage', isSelected: false}, {title: 'DigitalPerm', src: 'images/perm.jpg', price: 13200, duration: 180, description: 'Men&#39;s Haircut with Best Shampoo, Styling and Massage', isSelected: false}]},
            {name: 'Color', type: [{title: 'GrayColor', src: 'images/color.jpg', price: 4400, duration: 60, description: 'Men&#39;s Haircut with Best Shampoo, Styling and Massage', isSelected: false}, {title: 'FashionColor', src: 'images/color.jpg', price: 5500, duration: 90, description: 'Men&#39;s Haircut with Best Shampoo, Styling and Massage', isSelected: false}, {title: '3D DesignColor', src: 'images/color.jpg', price: 12200, duration: 150, description: 'Men&#39;s Haircut with Best Shampoo, Styling and Massage', isSelected: false}]},
            {name: 'Spa', type: [{title: '30min コース', src: 'images/spa.jpg', price: 3900, duration: 30, description: 'Men&#39;s Haircut with Best Shampoo, Styling and Massage', isSelected: false}, {title: '60min コース', src: 'images/spa.jpg', price: 7000, duration: 60, description: 'Men&#39;s Haircut with Best Shampoo, Styling and Massage', isSelected: false}, {title: '90min コース', src: 'images/spa.jpg', price: 11000, duration: 90, description: 'Men&#39;s Haircut with Best Shampoo, Styling and Massage', isSelected: false}]},
            {name: 'Treatment', type: [{title: 'Treatment', src: 'images/spa.jpg', price: 2200, duration: 30, description: 'Men&#39;s Haircut with Best Shampoo, Styling and Massage', isSelected: false}]},
        ]
    }),
    methods: {
        decimalSeparator(num){
            const number = `${num}`;
            const firstHalf = number.slice(0, number.length-3)
            const secondHalf = number.slice(number.length-3)
            return (num===0) ? 'free' : '¥ ' + firstHalf + ',' + secondHalf + '- 税込';
        },
        totalValue(v){
            return v=='free' ? '¥ ' + 0 + '- 税込' : v
        },
        calculateHour(duration){
            if (duration==30) {
                return duration+'分'
            } else if(duration%60){
                return Math.floor(duration/60)+'時間'+ 30 + '分';
            } else {
                return duration/60+'時間';
            }
        },
    }
}
