import React from 'react';
import { Composition } from 'remotion';
import { SkensaIntro } from './SkensaIntro';
import { TkjPromo } from './TkjPromo';

export const RemotionRoot: React.FC = () => {
    return (
        <>
            <Composition
                id="SkensaIntro"
                component={SkensaIntro}
                durationInFrames={330}
                fps={60}
                width={1920}
                height={1080}
            />
            <Composition
                id="TkjPromo"
                component={TkjPromo}
                durationInFrames={1800}
                fps={30}
                width={1920}
                height={1080}
            />
        </>
    );
};
